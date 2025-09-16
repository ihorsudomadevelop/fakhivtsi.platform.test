<?php
if ( ! function_exists('isRoleAdmin')) {
	/*** @return bool */
	function isRoleAdmin(): bool
	{
		return auth()->user()->role === 'admin';
	}
}