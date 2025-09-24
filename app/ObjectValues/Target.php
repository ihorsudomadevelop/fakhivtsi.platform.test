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
	/*** @var string */
	public const MINING = 'Мінування';
	/*** @var string */
	public const DELIVERY = 'Доставка';

	/*** @return string[] */
	public static function getList(): array
	{
		return [
			self::PERSONNEL     => self::PERSONNEL,
			self::SHELTER       => self::SHELTER,
			self::CROSSING      => self::CROSSING,
			self::FIRE_FIGHTING => self::FIRE_FIGHTING,
			self::MINING        => self::MINING,
			self::DELIVERY      => self::DELIVERY,
		];
	}
}