<?php
namespace Dfe\TBCBank;
use Df\Payment\Token;
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