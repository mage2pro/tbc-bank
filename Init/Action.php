<?php
namespace Dfe\TBCBank\Init;
use Df\Payment\Token;
use Df\Payment\W\Event as Ev;
/**
 * 2018-09-26
 * @method \Dfe\TBCBank\Method m()
 * @method \Dfe\TBCBank\Settings s()
 */
final class Action extends \Df\Payment\Init\Action {
	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\Payment\Init\Action::redirectParams()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @return array(string => mixed)
	 */
	protected function redirectParams() {return df_customer_session()->getDfeTBCParams();}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Init\Action::redirectUrl()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @return string
	 */
	protected function redirectUrl() {return 'https://ecommerce.ufc.ge/ecomm2/ClientHandler';}

	/**
	 * 2018-09-26 A string like «HOjPnNRq9KHNDKVnomSQUtShijw=».
	 * @override
	 * @see \Df\Payment\Init\Action::transId()
	 * @used-by \Df\Payment\Init\Action::action()
	 * @used-by action()
	 * @see \Dfe\TBCBank\W\Event::ttParent()
	 * @return string|null
	 */
	protected function transId() {return $this->e2i(Token::get($this->m()->ii()), Ev::T_INIT);}
}