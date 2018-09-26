<?php
namespace Dfe\TBCBank\T\CaseT;
/**
 * 2018-09-26
 */
final class MerchantHandler extends \Dfe\TBCBank\T\CaseT {
	/** @test 2018-09-26 */
	function t00() {}

	/** @test 2018-09-26 */
	function t01() {
		$curl = curl_init();
		$post_fields =
			"command=v&amount=100&currency=981&client_ip_addr=192.168.0.88&description=UFCTEST&msg_type=SMS";
		$submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
		curl_setopt($curl, CURLOPT_SSLCERT, $this->s()->certificate());
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->s()->password());
		curl_setopt($curl, CURLOPT_SSLVERSION, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_URL, $submit_url);
		curl_setopt($curl, CURLOPT_VERBOSE, '0');
		/**
		 * 2018-09-26 Dmitry Fedyuk
		 * The server responds with a string like «TRANSACTION_ID: HOjPnNRq9KHNDKVnomSQUtShijw=».
		 * A transaction ID always contains 28 characters.
		 */
		$result = curl_exec($curl);
		echo substr($result, -28);
	}
}