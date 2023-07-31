<?php
namespace Dfe\TBCBank\Test\CaseT;
use Dfe\TBCBank\API\Facade as F;
# 2018-11-09
final class Regular extends \Dfe\TBCBank\Test\CaseT {
	/** 2018-11-09 @test */
	function t00():void {}

	/** 2018-11-09 */
	function t01():void {echo __METHOD__ . ': ' . $this->transId();}

	/** 2018-11-13 */
	function t02():void {echo df_json_encode(dfa_merge_r(
		['TBCBank' => ['1111' => ['a' => 'b']]]
		,['TBCBank' => ['2222' => ['c' => 'd']]]
	));}

	/**
	 * 2018-11-13
	 * intval('02') => 2
	 */
	function t03():void {echo intval('02');}

	/** 2018-11-13 */
	function t04():void {echo df_json_encode([df_year(), df_month()]);}

	/**
	 * 2018-11-09
	 * @used-by self::t01()
	 */
	private function transId():string {return F::s()->initRegular([
		'amount' => 100 # 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		,'biller_client_id' => df_uid() # 2018-11-09 «merchant-selected regular payment identifier»
		# 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'client_ip_addr' => df_visitor_ip()
		,'command' => 'z'
		,'currency' => 981 # 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'description' => 'UFCTEST' # 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'perspayee_expiry' => '0199' # 2018-11-09 «preferred deadline for a regular payment MMYY»
		,'perspayee_gen' => 1
		,'perspayee_overwrite' => 1
		,'msg_type' => 'SMS'
	]);}
}