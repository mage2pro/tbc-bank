<?php
namespace Dfe\TBCBank\W;
// 2018-09-27
final class Reader extends \Df\Payment\W\Reader {
	/**
	 * 2018-09-27
	 * @override
	 * @see \Df\Payment\W\Reader::reqFilter()
	 * @used-by \Df\Payment\W\Reader::__construct()
	 * @param array(string => mixed) $r
	 * @return array(string => mixed)
	 */
	protected function reqFilter(array $r) {
		if (isset($r['trans_id'])) {
		}
		return $r;
	}
}