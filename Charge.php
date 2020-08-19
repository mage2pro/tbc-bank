<?php
namespace Dfe\TBCBank;
use Df\Payment\Init\Action;
/**
 * 2018-09-26
 * @method Method m()
 * @method Settings s()
 */
final class Charge extends \Df\Payment\Charge {
	/**
	 * 2018-12-05
	 * «If a customer name has any non latin characters description stays completely empty»:
	 * https://github.com/mage2pro/tbc-bank/issues/2
	 * @override
	 * @see \Df\Payment\Charge::textFilter()
	 * @used-by \Df\Payment\Charge::text()
	 * @param string $s
	 * @return string
	 */
	protected function textFilter($s) {return df_translit($s);}

	/**
	 * 2018-11-14
	 * @used-by pCharge()
	 * @used-by pNew()
	 * @return array(string => mixed)
	 */
	private function common() {return [
		# 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		'amount' => $this->amountF()
		# 2018-11-22
		# https://mail.google.com/mail/u/0/#inbox/KtbxLrjVmhsgbmXmbPwfTZjlgrJSSKJsVB
		# https://www.upwork.com/messages/rooms/room_dedb1119e1f5f4d8e506b963f506d8e4/story_61f60dab05ae5325df50dbaaf6d28d03
		,'biller' => $this->description()
		# 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'client_ip_addr' => df_visitor_ip()
		# 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'currency' => df_currency_num($this->currencyC())
		# 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'description' => $this->description()
	];}

	/**
	 * 2018-09-27
	 * @used-by p()
	 * @return array(string => mixed)
	 */
	private function pCharge() {
		$c = Action::sg($this->m())->preconfiguredToCapture();
		$t = $this->s()->tokenization(); /** @var bool $t */
		return $this->common() + [
			 # 2018-09-26 «identifies a request for transaction registration»
			'command' => !$c ? 'a' : ($t ? 'z' : 'v')
			/**
			 * 2018-10-06
			 * «SMS» means «Single Message System» (the «preauthorize and capture» action).
			 * «DMS» means «Dual Message System» (the «preauthorize only» action).
			 *
			 * «Procedure for processing transactions in one stage is called Single Message System (SMS).
			 * When using this system, withdrawal of funds from buyer’s card is done in 1 operation:
			 * request for authorization sent to issuer bank
			 * at the same time constitutes a financial confirmation of the payment.
			 * Therefore when acquirer bank receives a signal via payment system
			 * that authorization is confirmed, transaction is considered closed.
			 *
			 * Two-stage technology to process a transaction, known as Dual Message System (DMS),
			 * is slightly different from the first option.
			 * This system separates authorization from settlements as different software procedures.
			 * Preauth procedure that blocks the necessary amount on a client’s card account,
			 * and Capture procedure that debits the account may be apart for 7 to 28 days.»
			 * https://www.linkedin.com/pulse/sms-dms-procedure-process-transaction-ramalingom-sundaram-pillai
			 */
			,'msg_type' => $c ? 'SMS' : 'DMS'
		] + (!$t ? [] : [
			# 2018-11-13
			# «Выбранный ТСП идентификатор регулярного платежа.
			# Окончательное значение идентификатора регулярных платежей
			# формируется с помощью Merchant ID ТСП и значения указанного biller_client_id идентификатора.»
			# Mandatory.
			# https://mage2.pro/t/5740
			'biller_client_id' => df_uid(10)
			# 2018-11-13
			# «Предельный срок действия регулярного платежа в формате ММГГ»
			# Mandatory.
			# https://mage2.pro/t/5740
			,'perspayee_expiry' => '1299'
			# 2018-11-13
			# «Используется для генерации нового шаблона регулярного (рекуррентного) платежа»
			# Mandatory.
			# https://mage2.pro/t/5740
			,'perspayee_gen' => 1
		]);
	}

	/**
	 * 2018-09-27
	 * @used-by \Dfe\TBCBank\Session::init()
	 * @param Method|null $m [optional]
	 * @return array(string => mixed)
	 */
	static function p(Method $m = null) {return (new self($m ?: dfpm(__CLASS__)))->pCharge();}

	/**
	 * 2018-11-14 It is used only for repetitive payments via previously saved bank cards.
	 * @used-by \Dfe\TBCBank\Method::chargeNewParams()
	 * @param Method $m
	 * @return array(string => mixed)
	 */
	static function pNew(Method $m) {$i = new self($m); /** @var self $i */ return $i->common() + [
		# 2018-11-13
		# «Выбранный ТСП идентификатор регулярного платежа.
		# Окончательное значение идентификатора регулярных платежей
		# формируется с помощью Merchant ID ТСП и значения указанного biller_client_id идентификатора.»
		# Mandatory.
		# https://mage2.pro/t/5740
		'biller_client_id' => $i->token()
		,'command' => 'e' # 2018-11-14 «Повторное списание регулярного платежа»
	];}
}