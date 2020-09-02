<?php

Route::get('/', function(){
	redirect('/auth/login');
});

Route::group('/auth',['middleware' => [
	'AuthMiddleware'
	]] ,function(){
	Route::match(['get','post'], 'index', 'auth@index');
	Route::match(['get','post'], 'login/{recoverpass?}/{messages?}', 'auth@login');
	Route::match(['get','post'], 'forgot_password/{messages?}', 'auth@forgot_password');
	Route::match(['get','post'], 'checkmail', 'auth@checkmail');
	Route::match(['get','post'], 'recover_password/{guid}', 'auth@recover_password');
	Route::match(['get','post'], 'new_password/{messages?}', 'auth@new_password');
	Route::match(['get','post'], 'logout', 'auth@logout');
	Route::match(['get','post'], 'register/{messages?}', 'auth@register');
});

Route::group('/manage',['middleware' => [
	'LoginMiddleware'
	]] ,function(){

	// DASHBOARD
	Route::group('dashboard', function(){
		Route::get('/', 'manage/dashboard@index');
		Route::get('/index', 'manage/dashboard@index');
	});

	// ACCOUNT
	Route::group('account', function(){
		Route::match(['get','post'], 'account/{messages?}', 'manage/account@account');
		Route::match(['get','post'], 'logout', 'manage/account@logout');
	});

	// ORG
	Route::group('organizations', function(){
		Route::match(['get','post'], 'index', 'manage/organizations@index');
	});

	// OPTIONS
	Route::group('options', function(){
		Route::match(['get','post'], 'index', 'manage/options@index');
	});

	// USERS
	Route::group('users', function(){
		Route::match(['get','post'], 'managers', 'manage/users@managers');
		Route::match(['get','post'], 'operators', 'manage/users@operators');
		Route::match(['get','post'], 'login_as/{guid}', 'manage/users@login_as');
		Route::match(['get','post'], 'send_password/{guid}', 'manage/users@send_password');
	});
});
