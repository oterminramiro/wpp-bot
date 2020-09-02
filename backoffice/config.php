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
				'driver' => 'mysql',
                'prefix' => '',
            ],
            'sendgrid' => [
                'api' => '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',
                'name' => 'Auto Renta',
                'from' => 'no-reply@livesupport.digital'
            ]
        ];
    }
}
