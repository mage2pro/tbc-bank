<?php
namespace Dfe\TBCBank\Test\CaseT;
use Dfe\TBCBank\API\Facade as F;
use Zend_Http_Client as Z;
# 2018-09-26
final class Init extends \Dfe\TBCBank\Test\CaseT {
	/** 2018-09-26 */
	function t00() {}

	/** 2018-09-26 */
	function t01() {echo $this->transId();}

	/** 2018-09-26 */
	function t02() {
		$z = new Z('https://ecommerce.ufc.ge/ecomm2/ClientHandler', [
			'timeout' => 120
			/**
			 * 2017-07-16
			 * By default it is «Zend_Http_Client»: @see C::$config
			 * https://github.com/magento/zf1/blob/1.13.1/library/Zend/Http/Client.php#L126
			 */
			,'useragent' => 'Mage2.PRO'
		]); /** @var Z $r */
		$z->setMethod(Z::POST);
		$z->setParameterPost('trans_id', $this->transId());
		echo $z->request()->getBody();
	}

	/** 2018-09-26 */
	function t03() {echo df_currency_num('GEL') . ' ' . gettype(df_currency_num('GEL'));}
	
	/** @test 2018-11-11 */
	function t04() {echo F::s()->init([
		# 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		'amount' => 100
		# 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'client_ip_addr' => df_visitor_ip()
		,'command' => 'v'
		,'currency' => 981 # 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'description' => 'UFCTEST' # 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'msg_type' => 'SMS'
	]);}

	/**
	 * 2018-09-26
	 * @used-by self::t01()
	 * @used-by self::t02()
	 * @return string
	 */
	private function transId() {return F::s()->init([
		'amount' => 100 # 2018-09-26 «transaction amount in fractional units, mandatory (up to 12 digits)»
		,'client_ip_addr' => df_visitor_ip() # 2018-09-26 «client’s IP address, mandatory (15 characters)»
		,'command' => 'v'
		,'currency' => 981 # 2018-09-26 «transaction currency code (ISO 4217), mandatory, (3 digits)»
		,'description' => 'UFCTEST' # 2018-09-26 «transaction details, optional (up to 125 characters)»
		,'msg_type' => 'SMS'
	]);}
}