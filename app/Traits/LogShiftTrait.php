<?php

namespace App\Traits;

use App\Models\LogShift;

/**
 * Trait LogShiftTrait
 * @package App\Traits
 */
trait LogShiftTrait
{
	/**
	 * @param int         $shiftId
	 * @param string      $action
	 * @param string|NULL $field
	 * @param string|NULL $prevValue
	 * @param string|NULL $newValue
	 * @return void
	 */
	public function createLogShift(int $shiftId, string $action, ?string $field = NULL, ?string $prevValue = NULL, ?string $newValue = NULL): void
	{
		$log = new LogShift();
		$log->setUserId(auth()->id());
		$log->setShiftId($shiftId);
		$log->setAction($action);
		$log->setField($field);
		$log->setPrevValue($prevValue);
		$log->setNewValue($newValue);
		$log->save();
	}
}
