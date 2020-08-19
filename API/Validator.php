<?php
namespace Dfe\TBCBank\API;
# 2018-11-09
/** @used-by \Dfe\TBCBank\API\Client::responseValidatorC() */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2018-11-11
	 * 1) «In case of an error, the returned string of symbols begins with ‘error:‘.»
	 * 2) An error message: «error: parameter 'command' not specified».
	 * 3) An error response always ends with a new line for an unknown reason.
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return $this->r('error') ?: ('FAILED' !== $this->r('RESULT') ? null : (
		(string)__(($c = $this->r('RESULT_CODE')) ? "Dfe_TBCBank_R_$c" : 'An unknown error occured')
	));}

	/**
	 * 2018-11-11
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return !$this->long();}
}