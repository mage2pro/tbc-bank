<?php
namespace Dfe\TBCBank\Facade;
// 2018-11-12
final class Card implements \Df\StripeClone\Facade\ICard {
	/**
	 * 2018-11-12
	 * @used-by \Df\StripeClone\Facade\Card::create()
	 * @param array(string => mixed) $p
	 */
	function __construct($p) {$this->_p = $p;}

	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::brand()
	 * @return null
	 */
	function brand() {return null;}

	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::country()
	 * @return null
	 */
	function country() {return null;}

	/**
	 * 2018-11-13
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @return string
	 */
	function expMonth() {return substr($this->exp(), 0, 2);}

	/**
	 * 2018-11-13
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @return string
	 */
	function expYear() {return substr($this->exp(), -2);}

	/**
	 * 2018-11-13 The `RECC_PMNT_EXPIRY` value is present only if tokenization is enabled
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	function id() {return dfa($this->_p, 'RECC_PMNT_ID');}

	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::last4()
	 * @return string
	 */
	function last4() {return null;}

	/**
	 * 2018-11-12 A string like «5***********1223».
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::last4()
	 * @return string
	 */
	function numberMasked() {return dfa($this->_p, 'CARD_NUMBER');}

	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::owner()
	 * @return null
	 */
	function owner() {return null;}

	/**
	 * 2018-11-13 The `RECC_PMNT_EXPIRY` value is present only if tokenization is enabled.
	 * @used-by expMonth()
	 * @used-by expYear()
	 * @return string
	 */
	private function exp() {return strval(dfa($this->_p, 'RECC_PMNT_EXPIRY'));}

	/**
	 * 2018-11-12
	 * @used-by exp()
	 * @used-by id()
	 * @used-by numberMasked()
	 * @var array(string => string)
	 */
	private $_p;
}