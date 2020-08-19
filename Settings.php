<?php
namespace Dfe\TBCBank;
use Df\Payment\Settings\Proxy;
# 2018-09-26
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings\BankCard {
	/**
	 * 2018-09-26 https://stackoverflow.com/a/11038338
	 * @override
	 */
	function __destruct() {
		if ($this->_file) {
			fclose($this->_file);
		}
	}

	/**
	 * 2018-09-26 https://stackoverflow.com/a/11038338
	 * @used-by \Dfe\TBCBank\API\Client::zfConfig()
	 * @return string
	 */
	function certificate() {return dfc($this, function() {
		$this->_file = tmpfile();
		fwrite($this->_file, $this->v('certificate'));
		return stream_get_meta_data($this->_file)['uri'];
	});}

	/**
	 * 2018-09-26
	 * @used-by \Dfe\TBCBank\API\Client::zfConfig()
	 * @return string
	 */
	function password() {return $this->p();}

	/**
	 * 2019-01-14
	 * @used-by \Dfe\TBCBank\API\Client::proxy()
	 * @return Proxy
	 */
	function proxy() {return dfc($this, function() {return new Proxy($this->m());});}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\API\Settings::publicKey()
	 * @used-by \Df\StripeClone\ConfigProvider::config()
	 * @return string
	 */
	function publicKey() {return null;}

	/**
	 * 2018-11-13 «Enable Tokenization?»
	 * @used-by \Dfe\TBCBank\Charge::pCharge()
	 * @used-by \Dfe\TBCBank\Facade\Customer::cardsData()
	 * @used-by \Dfe\TBCBank\Init\Action::preconfigured()
	 * @return string
	 */
	function tokenization() {return $this->b();}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'df_payment/tbc_bank';}

	/**
	 * 2018-09-26
	 * @used-by __destruct()
	 * @used-by certificate()
	 * @var resource|null
	 */
	private $_file;
}