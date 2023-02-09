<?php
namespace Dfe\TBCBank\Facade;
use Df\API\Operation;
use Dfe\TBCBank\API\Facade as F;
use Dfe\TBCBank\W\Event as Ev;
# 2018-11-09
/** @method \Dfe\TBCBank\Method m() */
final class Charge extends \Df\StripeClone\Facade\Charge {
	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::capturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param int|float $a
	 * The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 */
	function capturePreauthorized(string $id, $a):Operation {return F::s()->post([
		'amount' => $a
		,'trans_id' => $id
		,'client_ip_addr' => $this->tm()->req('client_ip_addr')
		,'command' => 't'
		,'currency' => df_currency_num($this->m()->cPayment())
	]);}

	/**
	 * 2018-11-14 It is used only for repetitive payments via previously saved bank cards.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 */
	function create(array $p):Operation {return F::s()->post($p);}

	/**
	 * 2018-11-16
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param Operation $c
	 */
	function id($c):string {return $c[Ev::TID];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::pathToCard()
	 * @used-by \Df\StripeClone\Block\Info::cardDataFromChargeResponse()
	 * @used-by \Df\StripeClone\Facade\Charge::cardData()
	 * @return null
	 */
	function pathToCard() {return null;}

	/**
	 * 2018-11-09
	 * 2022-12-19 The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::refund()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @return null
	 */
	function refund(string $id, int $a) {return null;}

	/**
	 * 2018-11-14
	 * 1) A new token looks like «6ZysGdr05Lvo6p2ieDvg7/fzdeU=».
	 * It always consists of 28 characters and always ends with `=`.
	 * 2) A registered token looks like «4349958401».
	 * It is generated by @see df_uid()
	 * in @see \Dfe\TBCBank\Charge::pCharge().
	 * It always consists of 10 characters.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::tokenIsNew()
	 * @used-by \Df\StripeClone\Payer::tokenIsNew()
	 * @used-by \Dfe\TBCBank\Init\Action::isRecurring()
	 */
	function tokenIsNew(string $id):bool {return df_ends_with($id, '=');}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @return null
	 */
	function void(string $id) {return null;}
}