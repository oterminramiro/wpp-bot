<?php

/**
 * CLI Routes
 *
 * This routes only will be available under a CLI environment
 */

// To enable Luthier-CI built-in cli commands
// uncomment the followings lines:

Luthier\Cli::maker();
Luthier\Cli::migrations();

// Issues
Route::cli('/cron/demo/handler','cron/demo@handler');
Route::cli('/cron/demo/demo','cron/demo@demo');
