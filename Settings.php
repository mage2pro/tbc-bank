<?php
namespace Dfe\TBCBank;
// 2018-09-26
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings {
	/**
	 * 2018-09-26
	 * @return string
	 */
	function certificate() {return $this->v();}

	/**
	 * 2018-09-26
	 * @used-by \Dfe\TBCBank\T\CaseT\MerchantHandler::t01()
	 * @return string
	 */
	function password() {return $this->p();}
}