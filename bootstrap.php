<?php

// Set error reporting to log all errors
error_reporting(E_ALL);

// Define the log file path
$logFilePath = __DIR__ . '/tests/logs/error_log.txt';

// Custom error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($logFilePath) {
    $logMessage = "[" . date('Y-m-d H:i:s') . "] Error: $errstr in $errfile on line $errline" . PHP_EOL;
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    return false; // Let the default error handler run as well
});

// Custom shutdown function to catch fatal errors
register_shutdown_function(function () use ($logFilePath) {
    $error = error_get_last();
    if ($error !== NULL) {
        $logMessage = "[" . date('Y-m-d H:i:s') . "] Fatal Error: {$error['message']} in {$error['file']} on line {$error['line']}" . PHP_EOL;
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }
});
