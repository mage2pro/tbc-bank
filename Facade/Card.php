<?php
namespace Dfe\TBCBank\Facade;
// 2018-11-09
final class Card implements \Df\StripeClone\Facade\ICard {
	/**
	 * 2018-11-09
	 * @used-by \Df\StripeClone\Facade\Card::create()
	 * @param array(string => mixed) $p
	 */
	function __construct($p) {$this->_p = $p;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::brand()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	function brand() {return $this->_p['brand'];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::country()
	 * @used-by \Df\StripeClone\CardFormatter::country()
	 * @return null
	 */
	function country() {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return int
	 */
	function expMonth() {return $this->_p['month'];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return int
	 */
	function expYear() {return $this->_p['year'];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()   
	 * @used-by \Dfe\Stripe\Method::cardType()
	 * @return string
	 */
	function id() {return $this->_p['id'];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::last4()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	function last4() {return $this->_p['last4'];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::owner()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return null
	 */
	function owner() {return $this->_p['name'];}

	/**
	 * 2018-11-09
	 * @var array(string => string)
	 */
	private $_p;
}