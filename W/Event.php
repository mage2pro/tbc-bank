<?php
namespace Dfe\TBCBank\W;
use Df\Payment\Init\Action as A;
# 2018-09-27
final class Event extends \Df\StripeClone\W\Event {
	/**
	 * 2018-11-12
	 * @override
	 * @used-by \Dfe\TBCBank\Block\Info::prepare()
	 */
	function _3dsStatus():string {return $this->r('3DSECURE');}

	/**
	 * 2018-11-13
	 * @used-by \Dfe\TBCBank\W\Strategy\ConfirmPending::onSuccess()
	 * @return string|null
	 */
	function cardId() {return $this->r(self::CARD_ID);}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\Payment\W\Event::isSuccessful()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 */
	function isSuccessful():bool {return 'OK' === $this->paymentStatus();}

	/**
	 * 2018-11-12
	 * @override
	 * @used-by self::isSuccessful()
	 * @used-by \Dfe\TBCBank\Block\Info::prepare()
	 */
	function paymentStatus():string {return $this->r('RESULT');}

	/**
	 * 2018-11-12
	 * @override
	 * @used-by \Dfe\TBCBank\Block\Info::prepare()
	 * @return int|null
	 */
	function rrn() {return ($r = $this->r('RRN')) ? intval($r) : $r;}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\StripeClone\W\Event::k_pidSuffix()
	 * @used-by \Df\StripeClone\W\Event::k_pid()
	 */
	protected function k_pidSuffix():string {return self::TID_SHORT;}

	/**
	 * 2018-09-28 The data have a flat structure.
	 * @override
	 * @see \Df\StripeClone\W\Event::roPath()
	 * @used-by \Df\StripeClone\W\Event::k_pid()
	 * @used-by \Df\StripeClone\W\Event::ro()
	 */
	protected function roPath():string {return '';}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\Payment\W\Event::ttCurrent()
	 * @used-by \Df\StripeClone\W\Nav::id()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 */
	function ttCurrent():string {return A::sg($this->m())->preconfiguredToCapture() ? self::T_CAPTURE : self::T_AUTHORIZE;}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\StripeClone\W\Event::ttParent()
	 * @used-by \Df\StripeClone\W\Nav::pidAdapt()
	 * @see \Dfe\TBCBank\Init\Action::transId()
	 */
	function ttParent():string {return self::T_INIT;}
	/**
	 * 2018-11-13
	 * @used-by self::cardId()
	 * @used-by \Dfe\TBCBank\Facade\Card::id()
	 * @used-by \Dfe\TBCBank\W\Strategy\ConfirmPending::onSuccess()
	 */
	const CARD_ID = 'RECC_PMNT_ID';

	/**
	 * 2018-11-14
	 * @used-by \Dfe\TBCBank\Facade\Card::exp()
	 * @used-by \Dfe\TBCBank\W\Strategy\ConfirmPending::onSuccess()
	 */
	const CARD_EXP = 'RECC_PMNT_EXPIRY';

	/**
	 * 2018-11-14
	 * @used-by \Dfe\TBCBank\Facade\Card::numberMasked()
	 * @used-by \Dfe\TBCBank\W\Strategy\ConfirmPending::onSuccess()
	 */
	const CARD_NUMBER = 'CARD_NUMBER';

	/**
	 * 2018-11-16
	 * @used-by \Dfe\TBCBank\Facade\Charge::id()
	 */
	const TID = 'TRANSACTION_ID';

	/**
	 * 2018-11-16
	 * @used-by self::k_pidSuffix()
	 * @used-by \Dfe\TBCBank\W\Reader::reqFilter()
	 */
	const TID_SHORT = 'trans_id';
}