<?php
namespace Dfe\TBCBank;
# 2021-10-27 "Improve the custom session data handling interface": https://github.com/mage2pro/core/issues/163
final class Session extends \Df\Customer\SessionBase {
	/**
	 * 2021-10-27
	 * @used-by \Dfe\TBCBank\Init::p()
	 * @used-by \Dfe\TBCBank\Init\Action::redirectParams()
	 * @param array(string => mixed)|string $v [optional]
	 * @return $this|array(string => mixed)
	 */
	function data($v = DF_N) {return df_prop($this, $v, []);}
}