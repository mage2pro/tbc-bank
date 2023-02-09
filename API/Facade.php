<?php
namespace Dfe\TBCBank\API;
use Df\Core\Exception as DFE;
use Dfe\TBCBank\W\Event;
# 2018-11-11
/** @method static Facade s()  */
final class Facade extends \Df\API\Facade {
	/**
	 * 2018-11-11
	 * A response looks like:
	 *	[
	 *		"RESULT: OK",
	 *		"RESULT_CODE: 000",
	 *		"3DSECURE: AUTHENTICATED",
	 *		"RRN: 827016795306",
	 *		"APPROVAL_CODE: 228017",
	 *		"CARD_NUMBER: 5***********1988"
	 *	]
	 * @used-by \Dfe\TBCBank\W\Reader::reqFilter()
	 * @return array(string => string)
	 * @throws DFE
	 */
	function check(string $id):array {return $this->post([
		'client_ip_addr' => df_visitor_ip(), 'command' => 'c', 'trans_id' => $id
	])->a();}

	/**
	 * 2018-11-11 It returns a string like «rm2opABtitnKMNPjcybjvAQ5H9g=»
	 * @used-by \Dfe\TBCBank\Init::p()
	 * @used-by \Dfe\TBCBank\Test\CaseT\Init::transId()
	 * @throws DFE
	 */
	function init(array $p):string {return $this->postAndReturnId($p);}

	/**
	 * 2018-11-11 It returns a string like «rm2opABtitnKMNPjcybjvAQ5H9g=»
	 * @used-by \Dfe\TBCBank\Test\CaseT\Regular::transId()
	 * @throws DFE
	 */
	function initRegular(array $p):string {return $this->postAndReturnId($p);}

	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 */
	protected function path(string $id, string $suf = ''):string {return '';}

	/**
	 * 2018-11-11 It returns a string like «rm2opABtitnKMNPjcybjvAQ5H9g=»
	 * @used-by self::init()
	 * @used-by self::initRegular()
	 * @param array $p
	 * @return string
	 * @throws DFE
	 */
	private function postAndReturnId(array $p) {return $this->post($p)['TRANSACTION_ID'];}
}