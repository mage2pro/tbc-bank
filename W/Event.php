<?php
namespace Dfe\TBCBank\W;
// 2018-09-27
final class Event extends \Df\PaypalClone\W\Event {
	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\PaypalClone\W\Event::k_idE()
	 * @used-by \Df\PaypalClone\W\Event::idE()
	 * @return null
	 */
	protected function k_idE() {return Reader::ID;}

	/**
	 * 2018-09-28
	 * @override
	 * @see \Df\Payment\W\Event::k_pid()
	 * @used-by \Df\Payment\W\Event::pid()
	 * @return string
	 */
	protected function k_pid() {return Reader::ID;}
	
	/**
	 * 2018-09-27
	 * This method is never used: @see validate()
	 * @override
	 * @see \Df\PaypalClone\W\Event::k_signature()
	 * @return string
	 */
	protected function k_signature() {return null;}

	/**
	 * 2018-09-27
	 * @override
	 * @see \Df\PaypalClone\W\Event::k_status()
	 * @used-by \Df\PaypalClone\W\Event::status()
	 * @return string|null
	 */
	protected function k_status() {return 'RESULT';}

	/**
	 * 2018-09-27
	 * @override
	 * @see \Df\PaypalClone\W\Event::validate()
	 * @used-by \Df\Payment\W\Handler::handle()
	 */
	function validate() {}
}