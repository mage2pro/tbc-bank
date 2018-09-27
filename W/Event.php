<?php
namespace Dfe\TBCBank\W;
// 2018-09-27
final class Event extends \Df\StripeClone\W\Event {
	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\Payment\W\Event::isSuccessful()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 * @return bool
	 */
	function isSuccessful() {return 'OK' === $this->r('RESULT');}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\StripeClone\W\Event::k_pidSuffix()
	 * @used-by \Df\StripeClone\W\Event::k_pid()
	 * @return string
	 */
	protected function k_pidSuffix() {return Reader::ID;}

	/**
	 * 2018-09-28 The data have a flat structure.
	 * @override
	 * @see \Df\StripeClone\W\Event::roPath()
	 * @used-by \Df\StripeClone\W\Event::k_pid()
	 * @used-by \Df\StripeClone\W\Event::ro()
	 * @return null
	 */
	protected function roPath() {return null;}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\StripeClone\W\Event::ttCurrent()
	 * @used-by \Df\StripeClone\W\Nav::id()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 * @return string
	 */
	function ttCurrent() {return self::T_CAPTURE;}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\StripeClone\W\Event::ttParent()
	 * @used-by \Df\StripeClone\W\Nav::pidAdapt()
	 * @see \Dfe\TBCBank\Init\Action::transId()
	 * @return string
	 */
	function ttParent() {return self::T_INIT;}
}