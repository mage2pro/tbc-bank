<?php
namespace Dfe\TBCBank;
// 2018-09-26
final class Method extends \Df\PaypalClone\Method {
	/**
	 * 2018-09-26
	 * @override
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}

	/**
	 * 2018-09-26
	 * @used-by \Df\Payment\Method::codeS()
	 * @see \Df\Payment\Settings::prefix()
	 */
	const CODE = 'dfe_tbc_bank';
}