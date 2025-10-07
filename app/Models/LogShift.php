<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogShift
 * @property integer     user_id
 * @property integer     shift_id
 * @property string      action
 * @property string|NULL field
 * @property string|NULL prev_value
 * @property string|NULL new_value
 * @package App\Models
 */
class LogShift extends Model
{
	use HasFactory;

	/*** @return int */
	public function getUserId(): int
	{
		return $this->user_id;
	}

	/**
	 * @param int $userId
	 * @return void
	 */
	public function setUserId(int $userId): void
	{
		$this->user_id = $userId;
	}

	/*** @return int */
	public function getShiftId(): int
	{
		return $this->shift_id;
	}

	/**
	 * @param int $shiftId
	 * @return void
	 */
	public function setShiftId(int $shiftId): void
	{
		$this->shift_id = $shiftId;
	}

	/*** @return string */
	public function getAction(): string
	{
		return $this->action;
	}

	/**
	 * @param string $action
	 * @return void
	 */
	public function setAction(string $action): void
	{
		$this->action = $action;
	}

	/*** @return string|NULL */
	public function getField(): ?string
	{
		return $this->field;
	}

	/**
	 * @param string|NULL $field
	 * @return void
	 */
	public function setField(?string $field): void
	{
		$this->field = $field;
	}

	/*** @return string|NULL */
	public function getPrevValue(): ?string
	{
		return $this->prev_value;
	}

	/**
	 * @param string|NULL $prevValue
	 * @return void
	 */
	public function setPrevValue(?string $prevValue): void
	{
		$this->prev_value = $prevValue;
	}

	/*** @return string|NULL */
	public function getNewValue(): ?string
	{
		return $this->new_value;
	}

	/**
	 * @param string|NULL $newValue
	 * @return void
	 */
	public function setNewValue(?string $newValue): void
	{
		$this->new_value = $newValue;
	}
}
