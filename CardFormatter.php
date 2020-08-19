<?php
namespace Dfe\TBCBank;
use Dfe\TBCBank\Facade\Card as C;
# 2018-11-12
/** @method C c() */
final class CardFormatter extends \Df\StripeClone\CardFormatter {
	/**
	 * 2017-07-19
	 * @override
	 * @see \Df\StripeClone\CardFormatter::label()
	 * @used-by \Df\StripeClone\Block\Info::prepare()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @return string
	 */
	function label() {return $this->c()->numberMasked();}
}


