<?php
namespace Dfe\TBCBank;
/**
 * 2018-09-26
 * @method Method m()
 * @method Settings s()
 */
final class Charge extends \Df\Payment\Charge {
	/**
	 * 2017-08-19
	 * @override
	 * @see \Df\PaypalClone\Charge::k_Amount()
	 * @used-by \Df\PaypalClone\Charge::p()
	 * @return string
	 */
	protected function k_Amount() {return '';}

	/**
	 * 2017-08-19
	 * @override
	 * @see \Df\PaypalClone\Charge::k_MerchantId()
	 * @used-by \Df\PaypalClone\Charge::p()
	 * @return string
	 */
	protected function k_MerchantId() {return '';}

	/**
	 * 2017-04-18
	 * @override
	 * @see \Df\PaypalClone\Charge::pCharge()
	 * @used-by \Df\PaypalClone\Charge::p()
	 * @return array(string => mixed)
	 */
	protected function pCharge() {$s = $this->s(); return [
		// 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		'amount' => $this->amountF()
		// 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'client_ip_addr' => df_visitor_ip()
		,'command' => 'v' // 2018-09-26 «identifies a request for transaction registration»
		// 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'currency' => df_currency_num($this->currencyC())
		,'description' => 'UFCTEST' // 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'msg_type' => 'SMS' // 2018-09-26 «STUB»
	];}

	/**
	 * 2017-04-18
	 * @override
	 * @see \Df\PaypalClone\Charge::k_RequestId()
	 * @used-by \Df\PaypalClone\Charge::p()
	 * @return string
	 */
	protected function k_RequestId() {return '';}

	/**
	 * 2017-04-18
	 * @override
	 * @see \Df\PaypalClone\Charge::k_Signature()
	 * @used-by \Df\PaypalClone\Charge::p()
	 * @return string
	 */
	protected function k_Signature() {return '';}
}