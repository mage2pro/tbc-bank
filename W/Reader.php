<?php
namespace Dfe\TBCBank\W;
use Dfe\TBCBank\Api;
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
		if ($t = dfa($r, self::ID)) {  /** @var string $t */
			/**
			 * 2018-09-27
			 * A response looks like:
			 *	[
			 *		"RESULT: OK",
			 *		"RESULT_CODE: 000",
			 *		"3DSECURE: AUTHENTICATED",
			 *		"RRN: 827016795306",
			 *		"APPROVAL_CODE: 228017",
			 *		"CARD_NUMBER: 5***********1988"
			 *	]
			 * 2018-09-28
			 * I use `+=` to preserve `trans_id` in the result.
			 * It is @used-by \Dfe\TBCBank\W\Event::k_pid()
			 */
			$r += df_parse_colon(Api::p([
				// 2018-09-26 «client’s IP address, mandatory (15 characters)»
				'client_ip_addr' => df_visitor_ip()
				,'command' => 'c'
				,self::ID => $t
			]));
		}
		return $r;
	}

	/**
	 * 2018-09-28
	 * @used-by reqFilter()
	 * @used-by \Dfe\TBCBank\W\Event::k_pid()
	 */
	const ID = 'trans_id';
}