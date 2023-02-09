<?php
namespace Dfe\TBCBank\Block;
use Dfe\TBCBank\W\Event as E;
# 2018-11-12
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class Info extends \Df\StripeClone\Block\Info {
	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::cardData()
	 * @used-by \Df\StripeClone\Block\Info::card()
	 * @return array(string => mixed)
	 */
	final protected function cardData():array {return dfc($this, function():array {return
		$this->ci() ?: (($ev = $this->tm()->responseF()) ? $ev->r() : [])
	;});}
	
	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::cardNumberLabel()
	 * @used-by \Df\StripeClone\Block\Info::prepare()
	 */
	final protected function cardNumberLabel():string {return 'Card Number';}

	/**
	 * 2018-11-16
	 * @override
	 * @see \Df\Payment\Block\Info::ciId()
	 * @used-by self::prepare()
	 * @used-by \Df\Payment\Block\Info::ci();
	 * @return string
	 */
	final protected function ciId() {return $this->tm()->req('biller_client_id');}

	/**
	 * 2018-11-12
	 * @override
	 * @see \Df\StripeClone\Block\Info::prepare()
	 * @used-by \Df\Payment\Block\Info::prepareToRendering()
	 */
	final protected function prepare():void {
		parent::prepare();
		 /** @var string|null $cardId */ /** @var array(string => string) $r */
		if ($this->ciId() && ($r = $this->tm()->res0())) {
			$this->siEx([
				'Paid with a saved card' => 'yes'
				,'Payment Status' => dfa($r, 'RESULT')
				,'Retrieval Reference Number (RRN)' => dfa($r, 'RRN')
				,'Approval Code' => dfa($r, 'APPROVAL_CODE')
			]);
		}
		elseif ($e = $this->tm()->responseF()) { /** @var E $e */
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
	final protected function transIDLabel():string {return 'Tansaction ID';}
}