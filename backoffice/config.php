<?php

class AppConfig
{
	public static function get()
	{
		return [
			'core' => [
				'production_url' => 'http://localhost:8000/',
				'encryption_key' => '2baMmnTcZqnnX8t4gHHFTYyRW9aJGcts8pwM4a848CT8aAPRq6DP6fnSW73U8kThMvrHV9hQR29QVU3k9qPkjZuJZ2kyFERMV23r5E3arEChJGUfMfdsEYvzw2kEryeG',
				'encryption_secret' => '6JRaz3XeL4aEdqHCFpRzUSDnrGt7ywRMFcb79648bynrJKRezu4sdH5p7hZUuEtrrcXbs9a9Wusab9NyMv9rvtMgwBnJdFdURUt2J94nAk5t6VUPhKDAGSZUzEHvwLmx',
			],
			'db' => [
				'hostname' => 'database',
				'username' => 'root',
				'password' => 'password',
				'database' => 'flask',
				'driver' => 'mysqli',
				'port' => 3306,
				'prefix' => '',
			],
			'sendgrid' => [
				'api' => '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',
				'name' => 'Wpp Bot',
				'from' => 'oterminramiro@gmail.com'
			]
		];
	}
}
