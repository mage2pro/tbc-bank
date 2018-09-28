<?php
namespace Dfe\TBCBank;
// 2018-09-28
final class ConfigProvider extends \Df\Payment\ConfigProvider {
	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\Payment\ConfigProvider::config()
	 * @used-by \Df\Payment\ConfigProvider::getConfig()
	 * @return array(string => mixed)
	 */
	protected function config() {return [
		'pid' => urlencode('ZdmOxgSlAkkzvgc2DEeKBHLSZOo=')
	] + parent::config();}
}