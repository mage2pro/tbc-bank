<?php
namespace Dfe\TBCBank\W;
use Magento\Sales\Model\Order\Payment\Transaction as T;
// 2018-09-27
final class Event extends \Df\PaypalClone\W\Event {
	/**
	 * 2018-09-27
	 * This method is never used: @see validate()
	 * @override
	 * @see \Df\PaypalClone\W\Event::k_signature()
	 * @return string
	 */
	protected function k_signature() {return null;}
}