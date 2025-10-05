<?php

namespace App\ObjectValues;

/*** Class PositionStatus */
class PositionStatus
{
	/*** @var string */
	public const READY_TO_USE = 'Готова до використання';
	/*** @var string */
	public const ACTIVE = 'Активна';
	/*** @var string */
	public const TEMPORARY_NOT_ACTIVE = 'Тимчасово не активна';
	/*** @var string */
	public const NOT_ARMED = 'Не БГ';

	/*** @return string[] */
	public static function getList(): array
	{
		return [
			self::READY_TO_USE         => self::READY_TO_USE,
			self::ACTIVE               => self::ACTIVE,
			self::TEMPORARY_NOT_ACTIVE => self::TEMPORARY_NOT_ACTIVE,
			self::NOT_ARMED            => self::NOT_ARMED,
		];
	}
}