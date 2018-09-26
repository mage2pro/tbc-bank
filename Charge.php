<?php
namespace Dfe\TBCBank;
/**
 * 2018-09-26
 * @method Method m()
 * @method Settings s()
 */
final class Charge extends \Df\Payment\Charge {
	/**
	 * 2018-09-27
	 * @return array(string => mixed)
	 */
	private function pCharge() {$s = $this->s(); return [
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
	 * 2018-09-27
	 * @used-by \Dfe\TBCBank\Init\Action::transIdE()
	 * @param Method $m
	 * @return array(string => mixed)
	 */
	static function p(Method $m) {return (new self($m))->pCharge();}
}