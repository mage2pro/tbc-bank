<?php
namespace Dfe\TBCBank\Facade;
use Df\API\Operation;
// 2018-11-09
final class Refund extends \Df\StripeClone\Facade\Refund {
	/**
	 * 2018-11-09
	 * Метод должен вернуть идентификатор операции (не платежа!) в платёжной системе.
	 * Мы записываем его в БД и затем при обработке оповещений от платёжной системы
	 * смотрим, не было ли это оповещение инициировано нашей же операцией,
	 * и если было, то не обрабатываем его повторно.
	 * @override
	 * @see \Df\StripeClone\Facade\Refund::transId()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param Operation $r
	 * @return string
	 * Пример результата: «txn_19deRAFzKb8aMux1TLBWx6ZO».
	 */
	function transId($r) {return null;}
}