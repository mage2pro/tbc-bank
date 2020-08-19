<?php
namespace Dfe\TBCBank\W;
# 2018-11-13
final class Handler extends \Df\Payment\W\Handler {
	/**
	 * 2018-11-13
	 * @override
	 * @see \Df\Payment\W\Handler::strategyC()
	 * @used-by \Df\Payment\W\Handler::handle()
	 */
	protected function strategyC() {return \Dfe\TBCBank\W\Strategy\ConfirmPending::class;}
}