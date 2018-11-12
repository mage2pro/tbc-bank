<?php
namespace Dfe\TBCBank\Block;
// 2018-11-12
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class Info extends \Df\StripeClone\Block\Info {
	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::cardData()
	 * @used-by \Df\StripeClone\Block\Info::prepare()
	 * @return array(string => mixed)
	 */
	protected function cardData() {return ($ev = $this->tm()->responseF()) ? $ev->r() : [];}
	
	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::cardNumberLabel()
	 * @used-by \Df\StripeClone\Block\Info::prepare()
	 * @return string
	 */
	protected function cardNumberLabel() {return 'Card Number';}

	/**
	 * 2018-11-12       
	 * @override
	 * @see \Df\Payment\Block\Info::transIDLabel()
	 * @used-by \Df\Payment\Block\Info::siID()
	 * @return string
	 */
	protected function transIDLabel() {return 'Tansaction ID';}
}