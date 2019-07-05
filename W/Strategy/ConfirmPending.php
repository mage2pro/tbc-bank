<?php
namespace Dfe\TBCBank\W\Strategy;
use Dfe\TBCBank\W\Event as E;
/**
 * 2018-11-13
 * @used-by \Dfe\TBCBank\W\Handler::strategyC()
 * @method E e()
 */
final class ConfirmPending extends \Df\Payment\W\Strategy\ConfirmPending {
	/**
	 * 2018-11-13
	 * @override
	 * @see \Df\Payment\W\Strategy\ConfirmPending::onSuccess()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 */
	protected function onSuccess() {
		$e = $this->e(); /** @var E $e */
		if ($id = $e->cardId()) { /** @var string $id */
			df_ci_save($this, [$id => $e->r([E::CARD_NUMBER, E::CARD_EXP, E::CARD_ID])]);
		}
	}
}