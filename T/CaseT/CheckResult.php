<?php
namespace Dfe\TBCBank\T\CaseT;
use Dfe\TBCBank\Api;
// 2018-09-27
final class CheckResult extends \Dfe\TBCBank\T\CaseT {
	/** @test 2018-09-27 */
	function t00() {}

	/**
	 * 2018-09-27
	 * A response looks like:
	 * «RESULT: OK
	 * RESULT_CODE: 000
	 * 3DSECURE: AUTHENTICATED
	 * RRN: 827016795306
	 * APPROVAL_CODE: 228017
	 * CARD_NUMBER: 5***********1988»
	 */
	function t01() {echo df_json_encode(df_parse_colon(Api::p([
		// 2018-09-26 «client’s IP address, mandatory (15 characters)»
		'client_ip_addr' => df_visitor_ip()
		,'command' => 'c'
		,'trans_id' => 'DK4K/mkyiJZ2PSJc9NMdjfS3nds='
	])));}
}