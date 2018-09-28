<?php
namespace Dfe\TBCBank;
// 2018-09-28
final class Session {
	/**
	 * 2018-09-28
	 * @used-by \Dfe\TBCBank\ConfigProvider::config()
	 * @return string
	 */
	static function init() {return dfcf(function() {
		df_customer_session()->setDfeTBCId($r = substr(Api::p(Charge::p()), -28)); /** @var string $r */
		return $r;
	});}

	/**
	 * 2018-09-28
	 * @return string
	 */
	static function get() {return df_result_sne(df_customer_session()->getDfeTBCId());}
}