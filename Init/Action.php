<?php
namespace Dfe\TBCBank\Init;
use Df\Payment\Source\AC;
use Df\Payment\W\Event as Ev;
use Df\StripeClone\Facade\Charge as FCharge;
use Dfe\TBCBank\Session as Sess;
/**
 * 2018-09-26
 * @method \Dfe\TBCBank\Method m()
 * @method \Dfe\TBCBank\Settings s()
 */
final class Action extends \Df\Payment\Init\Action {
	/**
	 * 2018-11-13
	 * TBC Bank does not support the DMS mode for regular payments:
	 * https://mail.google.com/mail/u/0/#inbox/QgrcJHsNhNPHshCbgtCsSfmsVNWmgJnxvgV
	 * @override
	 * @see \Df\Payment\Init\Action::preconfigured()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @used-by \Df\Payment\Init\Action::preconfiguredToCapture()
	 */
	protected function preconfigured():string {return $this->s()->tokenization() ? AC::C : parent::preconfigured();}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\Payment\Init\Action::redirectParams()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @return array(string => mixed)
	 */
	protected function redirectParams():array {return Sess::s()->data();}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Init\Action::redirectUrl()
	 * @used-by \Df\Payment\Init\Action::action()
	 */
	protected function redirectUrl():string {return $this->isRecurring() ? '' : 'https://ecommerce.ufc.ge/ecomm2/ClientHandler';}

	/**
	 * 2018-09-26 A string like «HOjPnNRq9KHNDKVnomSQUtShijw=».
	 * @override
	 * @see \Df\Payment\Init\Action::transId()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @see \Dfe\TBCBank\W\Event::ttParent()
	 */
	protected function transId():string {return $this->isRecurring() ? '' : $this->e2i($this->token(), Ev::T_INIT);}

	/**
	 * 2018-11-14
	 * @used-by self::redirectUrl()
	 * @used-by self::transId()
	 */
	private function isRecurring():bool {return dfc($this, function() {return
		!FCharge::s($this->m())->tokenIsNew($this->token())
	;});}
}