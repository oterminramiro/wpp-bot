<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ResponseManager
{
	public static function getResponseMessage($code, $message, $success)
	{
		return [
			'success' => $success,
			'code' => $code,
			'response' => [
				'message' => $message
			]
		];
	}

	public static function getResponse($code, $message, $success)
	{
		return [
			'success' => $success,
			'code' => $code,
			'response' => $message
		];
	}

	public static function show404()
	{
		header('Content-Type: application/json');
		echo json_encode([
				'success' => false,
				'code' => 404,
				'response' => [
          'message' => 404
         ]
    ],	true);
	}

	public static function sendMessageAndHttpCode($httpCode, $success, $message)
	{
		http_response_code($httpCode);
		$response = [
		'success' => $success,
		'code' => $httpCode,
		'response' => [
			'message' => $message
		]
		];
		header('Content-Type: application/json');
		die(json_encode($response));
	}
}
