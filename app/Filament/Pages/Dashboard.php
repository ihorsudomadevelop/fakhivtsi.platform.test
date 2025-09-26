<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

/**
 * Class Dashboard
 * @package App\Filament\Pages
 */
class Dashboard extends Page
{
	/*** @var string|NULL */
	protected static ?string $navigationIcon = 'heroicon-o-document-text';
	/*** @var string */
	protected static string $view = 'filament.pages.dashboard';
	/*** @var string|NULL */
	protected ?string $heading = 'ПЛАТФОРМА ДЛЯ ВЕДЕННЯ ОБЛІКУ ТА ЗВІТНОСТІ (BETA TEST)';
}
