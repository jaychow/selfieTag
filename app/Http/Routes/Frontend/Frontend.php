<?php

/**
 * Frontend Controllers
 */
get('/', 'IgMineController@london')->name('home');
get('macros', 'FrontendController@macros');
get('london', 'IgMineController@london');
get('selfie', 'IgMineController@selfie');
get('map', 'IgMineController@map');
post('tagSelfie', 'IgMineController@tagSelfie');
delete('tagSelfie', 'IgMineController@removeTagSelfie');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function ()
{
	get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
	get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
	patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');

});