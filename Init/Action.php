<?php
namespace Dfe\TBCBank\Init;
use Df\Payment\W\Event as Ev;
use Dfe\TBCBank\Charge;
use Dfe\TBCBank\Method as M;
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
	protected function redirectUrl() {return
		"https://ecommerce.ufc.ge/ecomm2/ClientHandler?trans_id={$this->transIdE()}"
	;}

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
	 * @used-by redirectUrl()
	 * @used-by transId()
	 * @return string
	 */
	private function transIdE() {return dfc($this, function() {
		$curl = curl_init();
		$submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		/** @var M $m */ /** @var array(string => mixed) $req */
		df_sentry_extra($m = $this->m(), 'Request Params', $req = Charge::p($m));
		$m->iiaSetTRR($req);
		// 2018-09-26
		// https://stackoverflow.com/questions/5224790/curl-post-format-for-curlopt-postfields#comment35249942_5224940
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($req));
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
		return substr(curl_exec($curl), -28);
	});}
}