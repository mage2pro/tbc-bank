<?php
namespace Dfe\TBCBank\T\CaseT;
use Zend_Http_Client as Z;
/**
 * 2018-09-26
 */
final class Init extends \Dfe\TBCBank\T\CaseT {
	/** @test 2018-09-26 */
	function t00() {}

	/** 2018-09-26 */
	function t01() {echo $this->transId();}

	/** 2018-09-26 */
	function t02() {
		$z = new Z('https://ecommerce.ufc.ge/ecomm2/ClientHandler', [
			'timeout' => 120
			/**
			 * 2017-07-16
			 * By default it is «Zend_Http_Client»: @see C::$config
			 * https://github.com/magento/zf1/blob/1.13.1/library/Zend/Http/Client.php#L126
			 */
			,'useragent' => 'Mage2.PRO'
		]); /** @var Z $r */
		$z->setMethod(Z::POST);
		$z->setParameterPost('trans_id', $this->transId());
		echo $z->request()->getBody();
	}

	/** @test 2018-09-26 */
	function t03() {echo df_currency_num('GEL') . ' ' . gettype(df_currency_num('GEL'));}

	/**
	 * 2018-09-26
	 * @used-by t01()
	 * @used-by t02()
	 * @return string
	 */
	private function transId() {
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
	}
}