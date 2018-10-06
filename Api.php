<?php
namespace Dfe\TBCBank;
// 2018-09-27
final class Api {
	/**       
	 * 2018-09-27
	 * @used-by \Dfe\TBCBank\Method::charge()
	 * @used-by \Dfe\TBCBank\T\CaseT\CheckResult::t01()
	 * @used-by \Dfe\TBCBank\T\CaseT\Init::transId()
	 * @used-by \Dfe\TBCBank\W\Reader::reqFilter()
	 * @param array(string => string) $p
	 * @return string
	 */
	static function p(array $p) {
		$c = curl_init(); /** @var resource $c */
		$s = dfps(__CLASS__); /** @var Settings $s */
		// 2018-09-26
		// https://stackoverflow.com/questions/5224790/curl-post-format-for-curlopt-postfields#comment35249942_5224940
		curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($p));
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, '0');
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, '0');
		curl_setopt($c, CURLOPT_SSLCERT, $s->certificate());
		curl_setopt($c, CURLOPT_SSLKEYPASSWD, $s->password());
		curl_setopt($c, CURLOPT_SSLVERSION, 1);
		curl_setopt($c, CURLOPT_TIMEOUT, 120);
		curl_setopt($c, CURLOPT_URL, 'https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler');
		$r = curl_exec($c); /** @var string $r */
		curl_close($c);
		return $r;
	}
}