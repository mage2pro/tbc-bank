<?php
namespace Dfe\TBCBank\API;
use Df\Payment\Settings\Proxy;
use Dfe\TBCBank\Settings as S;
# 2018-11-09
final class Client extends \Df\API\Client {
	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {
		parent::_construct();
		# 2018-11-14
		# A response looks like:
		# «TRANSACTION_ID: jiqiowN8jjPx5+8+BLfZwv3PAhs=
		# RESULT: FAILED
		# RESULT_CODE: 102»
		# It contains newlines.
		$this->addFilterResBV('df_parse_colon'); /** @uses df_parse_colon() */
	}

	/**
	 * 2019-01-14
	 * @override
	 * @see \Df\API\Client::proxy()
	 * @used-by \Df\API\Client::setup()
	 * @return Proxy
	 */
	protected function proxy() {
		$s = dfps($this); /** @var S $s */
		$r = $s->proxy(); /** @var Proxy $r */
		return !$r->enable() ? null : $r;
	}

	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::_p()
	 */
	protected function responseValidatorC():string {return \Dfe\TBCBank\API\Validator::class;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 */
	protected function urlBase():string {return 'https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler';}

	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\API\Client::verifyCertificate()
	 * @used-by \Df\API\Client::setup()
	 */
	protected function verifyCertificate():bool {return false;}

	/**
	 * 2018-11-11
	 * https://framework.zend.com/manual/1.12/en/zend.http.client.adapters.html#zend.http.client.adapters.socket
	 * @override
	 * @see \Df\API\Client::zfConfig()
	 * @used-by \Df\API\Client::__construct()
	 * @return array(string => mixed)
	 */
	protected function zfConfig():array {$s = dfps($this); /** @var S $s */ return [
		# 2018-11-11 «Path to a PEM encoded SSL certificate»
		'sslcert' => $s->certificate()
		# 2018-11-11 «Path to a PEM encoded SSL certificate»
		,'sslpassphrase' => $s->password()
		/**
		 * 2018-11-11 «SSL transport layer (eg. 'sslv2', 'tls')».
		 * 2018-11-14 @see stream_get_transports()
		 */
		,'ssltransport' => 'tlsv1.2'
	];}
}