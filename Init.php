<?php
namespace Dfe\TBCBank;
use Dfe\TBCBank\API\Facade as F;
use Dfe\TBCBank\Session as Sess;
use Magento\Quote\Api\Data\AddressInterface as IQA;
use Magento\Quote\Api\Data\PaymentInterface as IQP;
use Magento\Quote\Model\Quote\Address as QA;
use Magento\Quote\Model\Quote\Payment as QP;
# 2018-09-28
final class Init {
	/**
	 * 2018-09-28 $cartId is a string like «63b25f081bfb8e4594725d8a58b012f7» for guests.
	 * 2017-04-20
	 * $qp в поле @see \Magento\Framework\DataObject::_data содержит код способа оплаты,
	 * а также ту дополнительную информацию, которую передала клиентская часть модуля оплаты.
	 * Например: [additional_data => [], method => "dfe_klarna"].
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * 2023-01-28
	 * «Method's return type must be specified using @return annotation»: https://github.com/mage2pro/core/issues/179
	 * @return string
	 */
	function guest(string $cartId, string $email, IQP $qp, IQA $ba = null):string {return $this->p();}

	/**
	 * 2018-09-28
	 * $qp в поле @see \Magento\Framework\DataObject::_data содержит код способа оплаты,
	 * а также ту дополнительную информацию, которую передала клиентская часть модуля оплаты.
	 * Например: [additional_data => [], method => "dfe_klarna"].
	 * @param int $cartId
	 * @param IQP|QP $qp
	 * @param IQA|QA|null $ba
	 * 2017-04-05 Важно возвращать именно string: @see dfw_encode()
	 * @return string
	 */
	function registered($cartId, IQP $qp, IQA $ba = null) {return $this->p();}

	/**
	 * 2018-09-29
	 * @used-by self::guest()
	 * @used-by self::registered()
	 * @return string
	 */
	private function p() {
		Sess::s()->data($p = Charge::p()); /** @var array(string => mixed) $p */
		return dfw_encode(['id' => F::s()->init($p)]);
	}
}