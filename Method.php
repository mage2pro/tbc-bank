<?php
namespace Dfe\TBCBank;
use Df\Payment\TM;
use Df\Payment\Token;
use Df\Payment\W\Event as Ev;
use Magento\Sales\Model\Order\Payment\Transaction as T;
// 2018-09-26
final class Method extends \Df\Payment\Method {
	/**
	 * 2018-10-06
	 * "Implement an ability to capture a preauthorized bank card payment from the Magento backend
	 * (the `CapturePayment` transaction)": https://github.com/mage2pro/alphacommercehub/issues/60
	 * @override
	 * @see \Df\Payment\Method::canCapture()
	 * 1) @used-by \Magento\Sales\Model\Order\Payment::canCapture():
	 *		if (!$this->getMethodInstance()->canCapture()) {
	 *			return false;
	 *		}
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order/Payment.php#L246-L269
	 * https://github.com/magento/magento2/blob/2.2.1/app/code/Magento/Sales/Model/Order/Payment.php#L277-L301
	 * 2) @used-by \Magento\Sales\Model\Order\Payment::_invoice():
	 *		protected function _invoice() {
	 *			$invoice = $this->getOrder()->prepareInvoice();
	 *			$invoice->register();
	 *			if ($this->getMethodInstance()->canCapture()) {
	 *				$invoice->capture();
	 *			}
	 *			$this->getOrder()->addRelatedObject($invoice);
	 *			return $invoice;
	 *		}
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order/Payment.php#L509-L526
	 * https://github.com/magento/magento2/blob/2.2.1/app/code/Magento/Sales/Model/Order/Payment.php#L542-L560
	 * 3) @used-by \Magento\Sales\Model\Order\Payment\Operations\AbstractOperation::invoice():
	 *		protected function invoice(OrderPaymentInterface $payment) {
	 *			$invoice = $payment->getOrder()->prepareInvoice();
	 *			$invoice->register();
	 *			if ($payment->getMethodInstance()->canCapture()) {
	 *				$invoice->capture();
	 *			}
	 *			$payment->getOrder()->addRelatedObject($invoice);
	 *			return $invoice;
	 *		}
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order/Payment/Operations/AbstractOperation.php#L56-L75
	 * https://github.com/magento/magento2/blob/2.2.1/app/code/Magento/Sales/Model/Order/Payment/Operations/AbstractOperation.php#L59-L78
	 * @return bool
	 */
	function canCapture() {return true;}

	/**
	 * 2018-10-06
	 * @override
	 * @see \Df\Payment\Method::canCapturePartial()
	 * @return bool
	 */
	function canCapturePartial() {return true;}

	/**
	 * 2018-10-06
	 * @override
	 * @see \Df\Payment\Method::canVoid()
	 * @used-by \Magento\Sales\Model\Order\Payment::canVoid():
	 *		public function canVoid() {
	 *			if (null === $this->_canVoidLookup) {
	 *				$this->_canVoidLookup = (bool)$this->getMethodInstance()->canVoid();
	 *				if ($this->_canVoidLookup) {
	 *					$authTransaction = $this->getAuthorizationTransaction();
	 *					$this->_canVoidLookup = (bool)$authTransaction && !(int)$authTransaction->getIsClosed();
	 *				}
	 *			}
	 *			return $this->_canVoidLookup;
	 *		}
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order/Payment.php#L528-L543
	 * https://github.com/magento/magento2/blob/2.2.1/app/code/Magento/Sales/Model/Order/Payment.php#L562-L578
	 * @return bool
	 */
	function canVoid() {return true;}

	/**
	 * 2018-10-06 It captures a preauthorized bank card payment.
	 * @override
	 * @see \Df\Payment\Method::charge()
	 * @used-by \Df\Payment\Method::authorize()
	 * @used-by \Df\Payment\Method::capture()
	 * @param bool|null $capture [optional]
	 */
	function charge($capture = true) {
		df_assert($capture);
		df_sentry_extra($this, 'Amount', $a = dfp_due($this)); /** @var float $a */
		df_sentry_extra($this, 'Need Capture?', df_bts($capture));
		/**
		 * 2017-11-11
		 * Despite of its name, @uses \Magento\Sales\Model\Order\Payment::getAuthorizationTransaction()
		 * simply returns the previous transaction, and it can be not only an `authorization` transaction,
		 * but a transaction of another type (e.g. `payment`) too.
		 * https://github.com/mage2pro/core/blob/3.4.2/StripeClone/Method.php#L124-L159
		 */
		$tPrev = $this->ii()->getAuthorizationTransaction(); /** @var T|false|null $tPrev */
		/**
		 * 2017-11-11
		 * The @see \Magento\Sales\Api\Data\TransactionInterface::TYPE_AUTH constant
		 * is absent in Magento < 2.1.0,
		 * but is present as @uses \Magento\Sales\Model\Order\Payment\Transaction::TYPE_AUTH
		 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order/Payment/Transaction.php#L37
		 * https://github.com/magento/magento2/blob/2.0.17/app/code/Magento/Sales/Api/Data/TransactionInterface.php
		 */
		df_assert($tPrev && T::TYPE_AUTH === $tPrev->getTxnType());
		df_sentry_extra($this, 'Parent Transaction ID', $txnId = $tPrev->getTxnId()); /** @var string $txnId */
		df_sentry_extra($this, 'Charge ID', $tid = $this->tid()->i2e($txnId, true)); /** @var string $tid */
		//$this->transInfo(fBankCard::s()->capture($a));
		$tm = df_tm($this); /** @var TM $tm */
		$res = df_parse_colon(Api::p($req = [
			// 2018-09-26 «client’s IP address, mandatory (15 characters)»
			'amount' => $this->amountFormat($a)
			,'trans_id' => $tid
			,'client_ip_addr' => $tm->req('client_ip_addr')
			,'command' => 't'
			,'currency' => df_currency_num($this->cPayment())
		]));
		dfp_report($this, $res, 'capture');
		$this->iiaSetTRR($req, $res);
		// 2016-12-16
		// Система в этом сценарии по-умолчанию формирует идентификатор транзации как
		// «<идентификатор родительской транзации>-capture».
		// У нас же идентификатор родительской транзации имеет окончание «-authorize»,
		// и оно нам реально нужно, поэтому здесь мы окончание «-authorize» вручную подменяем на «-capture».
		$this->ii()->setTransactionId($this->tid()->e2i($tid, Ev::T_CAPTURE));
	}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\Payment\Method::iiaKeys()
	 * @used-by \Df\Payment\Method::assignData()
	 * @return string[]
	 */
	protected function iiaKeys() {return [Token::KEY];}

	/**
	 * 2018-09-26
	 * @used-by \Df\Payment\Method::codeS()
	 * @see \Df\Payment\Settings::prefix()
	 */
	const CODE = 'dfe_tbc_bank';
}