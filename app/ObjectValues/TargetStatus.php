<?php

namespace App\ObjectValues;

/**
 * Class TargetStatus
 * @package App\ObjectValues
 */
class TargetStatus
{
	/*** @var string */
	public const NA = '-';
	/*** @var string */
	public const DELIVERED = 'Доставлено';
	/*** @var string */
	public const AFFECTED = 'Уражено';
	/*** @var string */
	public const AFFECTED_AFTER_ADJUSTMENT = 'Уражено (за коригуванням)';
	/*** @var string */
	public const NOT_AFFECTED = 'Не уражено';
	/*** @var string */
	public const NOT_AFFECTED_NO_DETONATION = 'Не уражено (без детонації)';
	/*** @var string */
	public const NOT_AFFECTED_LOSS_OF_SIDE = 'Не уражено (втрата борта)';
	/*** @var string */
	public const MINED = 'Заміновано';

	/*** @return string[] */
	public static function getList(): array
	{
		return [
			self::NA,
			self::DELIVERED,
			self::AFFECTED,
			self::AFFECTED_AFTER_ADJUSTMENT,
			self::NOT_AFFECTED,
			self::NOT_AFFECTED_NO_DETONATION,
			self::NOT_AFFECTED_LOSS_OF_SIDE,
			self::MINED,
		];
	}
}