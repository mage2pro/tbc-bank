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
	 */
	function certificate():string {return dfc($this, function():string {
		$this->_file = tmpfile();
		fwrite($this->_file, $this->v('certificate'));
		return stream_get_meta_data($this->_file)['uri'];
	});}

	/**
	 * 2018-09-26
	 * @used-by \Dfe\TBCBank\API\Client::zfConfig()
	 */
	function password():string {return $this->p();}

	/**
	 * 2019-01-14
	 * @used-by \Dfe\TBCBank\API\Client::proxy()
	 */
	function proxy():Proxy {return dfc($this, function() {return new Proxy($this->m());});}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\API\Settings::publicKey()
	 * @used-by \Df\StripeClone\ConfigProvider::config()
	 */
	function publicKey():string {return '';}

	/**
	 * 2018-11-13 «Enable Tokenization?»
	 * @used-by \Dfe\TBCBank\Charge::pCharge()
	 * @used-by \Dfe\TBCBank\Facade\Customer::cardsData()
	 * @used-by \Dfe\TBCBank\Init\Action::preconfigured()
	 */
	function tokenization():string {return $this->b();}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 */
	protected function prefix():string {return 'df_payment/tbc_bank';}

	/**
	 * 2018-09-26
	 * @used-by self::__destruct()
	 * @used-by self::certificate()
	 * @var resource|null
	 */
	private $_file;
}