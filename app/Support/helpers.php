<?php
if ( ! function_exists('isRoleAdmin')) {
	/*** @return bool */
	function isRoleAdmin(): bool
	{
		return auth()->user()->role === 'admin';
	}
}
if ( ! function_exists('isRoleOwner')) {
	/*** @return bool */
	function isRoleOwner(): bool
	{
		return auth()->user()->role === 'owner';
	}
}