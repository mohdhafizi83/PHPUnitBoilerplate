<?php

declare(strict_types=1);

// Composer autoloader — makes App\ and App\Tests\ classes available everywhere.
require __DIR__ . '/vendor/autoload.php';

// Report everything, including deprecations.
error_reporting(E_ALL);

// Custom error handler: append every error/warning/deprecation to the log file.
$logFilePath = __DIR__ . '/tests/logs/error_log.txt';
if (!is_dir(dirname($logFilePath))) {
    mkdir(dirname($logFilePath), 0777, true);
}

set_error_handler(static function (int $errno, string $errstr, string $errfile, int $errline) use ($logFilePath): bool {
    $logMessage = sprintf(
        "[%s] Error (%d): %s in %s on line %d%s",
        date('Y-m-d H:i:s'),
        $errno,
        $errstr,
        $errfile,
        $errline,
        PHP_EOL
    );
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    return false; // Let the default error handler (PHPUnit's) run as well.
});

// Catch fatal errors on shutdown.
register_shutdown_function(static function () use ($logFilePath): void {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        $logMessage = sprintf(
            "[%s] Fatal Error: %s in %s on line %d%s",
            date('Y-m-d H:i:s'),
            $error['message'],
            $error['file'],
            $error['line'],
            PHP_EOL
        );
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }
});
