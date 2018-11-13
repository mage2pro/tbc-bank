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
	 * 2018-11-13
	 * $id has the following structure in out case:
	 *	{
	 *		"4349958401": {
	 *			"CARD_NUMBER": "5***********1223",
	 *			"RECC_PMNT_EXPIRY": "1019"
	 *		},
	 *		"1779958449": {
	 *			"CARD_NUMBER": "4***********3333",
	 *			"RECC_PMNT_EXPIRY": "1120"
	 *		}
	 *	}
	 * The top-level keys are bank card tokens here, and their values form the corresponding bank card labels.
	 * So the TBCBank module (unlike the rest modules) does not do any API requests
	 * to retrieve a customer's saved cards.
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::_get()
	 * @used-by \Df\StripeClone\Facade\Customer::get()
	 * @param array(string => mixed) $id
	 * @return array(string => mixed)
	 */
	protected function _get($id) {return $id;}

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