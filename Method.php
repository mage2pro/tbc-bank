<?php
namespace Dfe\TBCBank;
use Df\Payment\Token;
use Magento\Sales\Model\Order\Payment\Transaction as T;
# 2018-09-26
/** @method Settings s() */
final class Method extends \Df\StripeClone\Method {
	/**
	 * 2018-10-06
	 * @override
	 * @see \Df\Payment\Method::canCapturePartial()
	 * @return bool
	 */
	function canCapturePartial() {return true;}

	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}

	/**
	 * 2018-11-14 It is used only for repetitive payments via previously saved bank cards.
	 * @override
	 * @see \Df\StripeClone\Method::chargeNewParams()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param bool $capture
	 * @return array(string => mixed)
	 */
	protected function chargeNewParams($capture) {return Charge::pNew($this);}

	/**
	 * 2018-09-29
	 * @override
	 * @see \Df\Payment\Method::iiaKeys()
	 * @used-by \Df\Payment\Method::assignData()
	 * @return string[]
	 */
	protected function iiaKeys() {return [Token::KEY];}

	/**
	 * 2018-11-09
	 * @override
	 * @see \Df\StripeClone\Method::transUrlBase()
	 * @used-by \Df\StripeClone\Method::transUrl()
	 * @param T $t
	 * @return string
	 */
	protected function transUrlBase(T $t) {return '';}

	/**
	 * 2018-09-26
	 * @used-by \Df\Payment\Method::codeS()
	 * @see \Df\Payment\Settings::prefix()
	 */
	const CODE = 'dfe_tbc_bank';
}