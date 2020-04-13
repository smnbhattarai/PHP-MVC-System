<?php

namespace Core;


use App\Config;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception)
    {
        // Error code handling
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: <strong>" . get_class($exception) . "</strong></p>";
            echo "<p>Message: <strong>" . $exception->getMessage() . "</strong></p>";
            echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in <strong>" . $exception->getFile() . "</strong> in line <strong>" . $exception->getLine() . "</strong></p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);
            $message = "Uncaught exception: " . get_class($exception);
            $message .= "Message: " . $exception->getMessage();
            $message .= "Stack trace: " . $exception->getTraceAsString();
            $message .= "Thrown in " . $exception->getFile() . " in line " . $exception->getLine();

            error_log($message);

            View::renderTemplate("$code.html");

        }


    }
}