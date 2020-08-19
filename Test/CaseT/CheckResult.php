<?php
namespace Dfe\TBCBank\Test\CaseT;
use Dfe\TBCBank\API\Facade as F;
# 2018-09-27
final class CheckResult extends \Dfe\TBCBank\Test\CaseT {
	/** @test 2018-09-27 */
	function t00() {}

	/**
	 * 2018-11-11
	 * A response looks like:
	 * «RESULT: OK
	 * RESULT_CODE: 000
	 * 3DSECURE: AUTHENTICATED
	 * RRN: 827016795306
	 * APPROVAL_CODE: 228017
	 * CARD_NUMBER: 5***********1988»
	 */
	function t01() {echo df_json_encode(F::s()->check('DK4K/mkyiJZ2PSJc9NMdjfS3nds='));}

	/** 2018-11-11 */
	function t02() {echo df_json_encode(F::s()->check('11DK4K/mkyiJZ2PSJc9NMdjfS3nds='));}
}