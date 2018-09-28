<?php
namespace Dfe\TBCBank;
// 2018-09-26
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2018-09-26
	 * @override
	 * https://stackoverflow.com/a/11038338
	 */
	function __destruct() {
		if ($this->_file) {
			fclose($this->_file);
		}
	}

	/**
	 * 2018-09-26
	 * https://stackoverflow.com/a/11038338
	 * @used-by \Dfe\TBCBank\Api::p()
	 * @return string
	 */
	function certificate() {return dfc($this, function() {
		$this->_file = tmpfile();
		fwrite($this->_file, $this->v('certificate'));
		return stream_get_meta_data($this->_file)['uri'];
	});}

	/**
	 * 2018-09-26
	 * @used-by \Dfe\TBCBank\Api::p()
	 * @return string
	 */
	function password() {return $this->p();}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\Payment\Settings::publicKey()
	 * @used-by \Df\StripeClone\ConfigProvider::config()
	 * @return string
	 */
	function publicKey() {return null;}

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