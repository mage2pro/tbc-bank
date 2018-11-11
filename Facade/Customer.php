<?php
namespace Dfe\TBCBank\Facade;
use Df\API\Operation;
// 2018-11-09
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param Operation $c
	 * @param string $token
	 * @return string
	 */
	function cardAdd($c, $token) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param array(string => mixed) $p
	 * @return Operation
	 */
	function create(array $p) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param Operation $c
	 * @return string
	 */
	function id($c) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::_get()
	 * @used-by \Df\StripeClone\Facade\Customer::get()
	 * @param int $id
	 * @return Operation|null
	 */
	protected function _get($id) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardsData()
	 * @used-by \Df\StripeClone\Facade\Customer::cards()
	 * @param Operation $c
	 * @return \Dfe\TBCBank\Facade\Card[]
	 * @see \Dfe\Stripe\Facade\Charge::cardData()
	 */
	protected function cardsData($c) {return [];}
}