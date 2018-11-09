<?php
namespace Dfe\TBCBank\T\CaseT;
use Dfe\TBCBank\Api;
use Zend_Http_Client as Z;
// 2018-11-09
final class Regular extends \Dfe\TBCBank\T\CaseT {
	/** 2018-11-09 */
	function t00() {}

	/** @test 2018-09-26 */
	function t01() {echo __METHOD__ . ': ' . $this->transId();}

	/**
	 * 2018-09-26
	 * @used-by t01()
	 * @used-by t02()
	 * @return string
	 */
	private function transId() {return Api::p([
		// 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		'amount' => 100
		,'biller_client_id' => df_uid() // 2018-11-09 «merchant-selected regular payment identifier»
		// 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'client_ip_addr' => df_visitor_ip()
		,'command' => 'z'
		,'currency' => 981 // 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'description' => 'UFCTEST' // 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'perspayee_expiry' => '0199' // 2018-11-09 «preferred deadline for a regular payment MMYY»
		,'perspayee_gen' => 1
		,'msg_type' => 'SMS'
	]);}
}