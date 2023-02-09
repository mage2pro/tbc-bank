<?php
namespace Dfe\TBCBank\Test\CaseT;
# 2018-11-11
final class Validator extends \Dfe\TBCBank\Test\CaseT {
	/** 2018-11-11 @test */
	function t00():void {}

	/** 2018-11-11 */
	function t01():void {echo df_json_encode([
		df_preg_prefix('error: ', "error: parameter 'command' not specified")
		,df_preg_prefix('error: ', 'TRANSACTION_ID: 6ZysGdr05Lvo6p2ieDvg7/fzdeU=')
		,df_preg_prefix('TRANSACTION_ID: ', "error: parameter 'command' not specified")
		,df_preg_prefix('TRANSACTION_ID: ', 'TRANSACTION_ID: 6ZysGdr05Lvo6p2ieDvg7/fzdeU=')
	]);}
}