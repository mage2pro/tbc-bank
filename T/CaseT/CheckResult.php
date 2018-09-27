<?php
namespace Dfe\TBCBank\T\CaseT;
use Zend_Http_Client as Z;
// 2018-09-27
final class CheckResult extends \Dfe\TBCBank\T\CaseT {
	/** @test 2018-09-27 */
	function t00() {}

	/** @test 2018-09-27 */
	function t01() {
		$curl = curl_init();
		$submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		// 2018-09-26
		// https://stackoverflow.com/questions/5224790/curl-post-format-for-curlopt-postfields#comment35249942_5224940
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
			// 2018-09-26 «client’s IP address, mandatory (15 characters)»
			'client_ip_addr' => df_visitor_ip()
			,'command' => 'c'
			,'trans_id' => 'DK4K/mkyiJZ2PSJc9NMdjfS3nds='
		]));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
		curl_setopt($curl, CURLOPT_SSLCERT, $this->s()->certificate());
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->s()->password());
		curl_setopt($curl, CURLOPT_SSLVERSION, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_URL, $submit_url);
		/**
		 * 2018-09-27
		 * A response looks like:
		 * RESULT: OK
		 * RESULT_CODE: 000
		 * 3DSECURE: AUTHENTICATED
		 * RRN: 827016795306
		 * APPROVAL_CODE: 228017
		 * CARD_NUMBER: 5***********1988
		 */
		$result = curl_exec($curl);
		echo $result;
	}
}