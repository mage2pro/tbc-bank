<?php
namespace Dfe\TBCBank\Facade;
# 2018-11-09
/** @method \Dfe\TBCBank\Settings ss() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2018-11-14 It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * 2022-11-13 It is similar to @see \Dfe\Vantiv\Facade\Customer::cardAdd()
	 * 2022-11-17
	 * `object` as an argument type is not supported by PHP < 7.2:
	 * https://github.com/mage2pro/core/issues/174#user-content-object
	 * 2022-12-19 We can not declare the $c argument type because it is undeclared in the overriden method.
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param object $c
	 */
	function cardAdd($c, string $token):string {df_should_not_be_here(); return '';}

	/**
	 * 2018-11-14 It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param array(string => mixed) $p
	 * @return null
	 */
	function create(array $p) {df_should_not_be_here(); return null;}

	/**
	 * 2018-11-14 It is never used because the TBCBank module does not use @see \Df\StripeClone\Payer::newCard()
	 * 2022-11-17
	 * `object` as an argument type is not supported by PHP < 7.2:
	 * https://github.com/mage2pro/core/issues/174#user-content-object
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param object $c
	 */
	function id($c):string {df_should_not_be_here(); return '';}

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