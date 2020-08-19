<?php
namespace Dfe\TBCBank\W;
use Dfe\TBCBank\API\Facade as F;
# 2018-09-27
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
		if ($t = dfa($r, Event::TID_SHORT)) {  /** @var string $t */
			/**
			 * 2018-09-28
			 * I use `+=` to preserve `trans_id` in the result.
			 * It is @used-by \Dfe\TBCBank\W\Event::k_pid()
			 */
			$r += F::s()->check($t);
		}
		return $r;
	}
}