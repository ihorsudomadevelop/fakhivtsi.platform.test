<?php

namespace App\ObjectValues;

/**
 * Class Target
 * @package App\ObjectValues
 */
class Target
{
	/*** @var string */
	public const PERSONNEL = 'ОС';
	/*** @var string */
	public const SHELTER = 'Укриття';
	/*** @var string */
	public const CROSSING = 'Переправа';
	/*** @var string */
	public const FIRE_FIGHTING = 'Пожежогасіння';

	/*** @return string[] */
	public static function getList(): array
	{
		return [
			self::PERSONNEL,
			self::SHELTER,
			self::CROSSING,
			self::FIRE_FIGHTING,
		];
	}
}