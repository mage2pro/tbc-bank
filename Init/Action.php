<?php
namespace Dfe\TBCBank\Init;
use Df\Payment\W\Event as Ev;
/**
 * 2018-09-26
 * @method \Dfe\TBCBank\Method m()
 * @method \Dfe\TBCBank\Settings s()
 */
final class Action extends \Df\Payment\Init\Action {
	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Init\Action::redirectUrl()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @return string
	 */
	protected function redirectUrl() {return '';}

	/**
	 * 2018-09-26 A string like «HOjPnNRq9KHNDKVnomSQUtShijw=».
	 * @override
	 * @see \Df\Payment\Init\Action::transId()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @used-by action()
	 * @return string|null
	 */
	protected function transId() {return $this->e2i($this->transIdE(), Ev::T_INIT);}

	/**
	 * 2018-09-26
	 * @used-by transId()
	 * @return string
	 */
	private function transIdE() {return dfc($this, function() {
		$curl = curl_init();
		$submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		// 2018-09-26
		// https://stackoverflow.com/questions/5224790/curl-post-format-for-curlopt-postfields#comment35249942_5224940
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
			// 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
			'amount' => 100
			// 2018-09-26 «client’s IP address, mandatory (15 characters)»
			,'client_ip_addr' => df_visitor_ip()
			,'command' => 'v' // 2018-09-26 «identifies a request for transaction registration»
			,'currency' => 981 // 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
			,'description' => 'UFCTEST' // 2018-09-26 «transaction details, optional (up to 125 characters)»
			,'msg_type' => 'SMS' // 2018-09-26 «STUB»
		]));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
		curl_setopt($curl, CURLOPT_SSLCERT, $this->s()->certificate());
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->s()->password());
		curl_setopt($curl, CURLOPT_SSLVERSION, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_URL, $submit_url);
		curl_setopt($curl, CURLOPT_VERBOSE, '0');
		// 2018-09-26
		// The server responds with a string like «TRANSACTION_ID: HOjPnNRq9KHNDKVnomSQUtShijw=».
		// A transaction ID always contains 28 characters.
		$result = curl_exec($curl);
		return substr($result, -28);
	});}
}