<?php
namespace Dfe\TBCBank\Signer;
// 2017-04-18
final class Response extends \Dfe\TBCBank\Signer {
	/**
	 * 2017-04-18
	 * @override
	 * @see \Dfe\TBCBank\Signer::values()
	 * @used-by \Dfe\TBCBank\Signer::sign()
	 * @return string[]
	 */
	protected function values() {return dfa_select_ordered($this->v(), []);}
}