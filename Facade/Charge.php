<?php
namespace Dfe\TBCBank\Facade;
use Df\API\Operation;
use Dfe\TBCBank\API\Facade as F;
// 2018-11-09
/** @method \Dfe\TBCBank\Method m() */
final class Charge extends \Df\StripeClone\Facade\Charge {
	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::capturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $id
	 * @param int|float $a
	 * The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @return Operation
	 */
	function capturePreauthorized($id, $a) {return F::s()->post([
		'amount' => $a
		,'trans_id' => $id
		,'client_ip_addr' => $this->tm()->req('client_ip_addr')
		,'command' => 't'
		,'currency' => df_currency_num($this->m()->cPayment())
	]);}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return Operation
	 */
	function create(array $p) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param Operation $c
	 * @return string
	 */
	function id($c) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::pathToCard()
	 * @used-by \Df\StripeClone\Block\Info::cardDataFromChargeResponse()
	 * @used-by \Df\StripeClone\Facade\Charge::cardData()
	 * @return string
	 */
	function pathToCard() {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::refund()
	 * @used-by void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @param float $a
	 * В формате и валюте платёжной системы.
	 * Значение готово для применения в запросе API.
	 * @return null
	 */
	function refund($id, $a) {return null;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::tokenIsNew()
	 * @used-by \Df\StripeClone\Payer::tokenIsNew()
	 * @param string $id
	 * @return bool
	 */
	function tokenIsNew($id) {return false;}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return null
	 */
	function void($id) {return null;}
}