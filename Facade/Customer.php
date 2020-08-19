<?php
namespace Dfe\TBCBank\Facade;
# 2018-11-09
/** @method \Dfe\TBCBank\Settings ss() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2018-11-14
	 * It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @param object $c
	 * @param string $token
	 * @return null
	 */
	function cardAdd($c, $token) {return null;}

	/**
	 * 2018-11-14
	 * It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @param array(string => mixed) $p
	 * @return null
	 */
	function create(array $p) {return null;}

	/**
	 * 2018-11-14
	 * It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @param object $c
	 * @return null
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
	 * 2018-11-14
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardsData()
	 * @used-by \Df\StripeClone\Facade\Customer::cards()
	 * @param array(string => mixed) $c
	 * @return \Dfe\TBCBank\Facade\Card[]
	 * @see \Dfe\Stripe\Facade\Charge::cardData()
	 */
	protected function cardsData($c) {return !$this->ss()->tokenization() ? [] : $c;}
}