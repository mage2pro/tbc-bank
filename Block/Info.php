<?php
namespace Dfe\TBCBank\Block;
use Dfe\TBCBank\W\Event as E;
// 2018-11-12
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class Info extends \Df\StripeClone\Block\Info {
	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::cardData()
	 * @used-by \Df\StripeClone\Block\Info::cf()
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
	 * @see \Df\StripeClone\Block\Info::prepare()
	 * @used-by \Df\Payment\Block\Info::prepareToRendering()
	 */
	final protected function prepare() {
		parent::prepare();
		if ($e = $this->tm()->responseF()) { /** @var E $e */
			$this->siEx([
				'Payment Status' => $e->paymentStatus()
				,'3D-Secure Status' => $e->_3dsStatus()
				,'Retrieval Reference Number (RRN)' => $e->rrn()
				,'Card ID' => $this->cf()->c()->id()
			]);
		}
	}

	/**
	 * 2018-11-12       
	 * @override
	 * @see \Df\Payment\Block\Info::transIDLabel()
	 * @used-by \Df\Payment\Block\Info::siID()
	 * @return string
	 */
	protected function transIDLabel() {return 'Tansaction ID';}
}