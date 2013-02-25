<?php

class ErrorHandler
{
	public static function register()
	{
		//register_shutdown_function(array(__CLASS__, '_shutdownHandler'));
		set_exception_handler(array(__CLASS__, '_exceptionHandler'));
		set_error_handler(array(__CLASS__, '_errorHandler'));
	}

	public static function _shutdownHandler()
	{
		$error = error_get_last();
		if($error)
			self::_exceptionHandler(new \FatalErrorException($error['message'], 0, $error['type'], $error['file'], $error['line'], NULL));
	}

	public static function _exceptionHandler(\Exception $exception)
	{
		if (!headers_sent()) { // for PHP < 5.2.4
			$protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
			header($protocol . ' 500', TRUE, 500);
		}


		echo "<pre>FATAL ERROR: thrown ", get_class($exception), ": <br>", $exception->getMessage(),
			"\n\t in file: ", $exception->getFile(),
			"\n\t on line: ".$exception->getLine()."</pre>";

		exit(255);
	}


	public static function _errorHandler($severity, $message, $file, $line, $context)
	{

		error_reporting(E_ALL | E_STRICT);

		if ($severity === E_RECOVERABLE_ERROR || $severity === E_USER_ERROR
				|| $severity === E_WARNING || $severity === E_WARNING) {
			throw new \FatalErrorException($message, 0, $severity, $file, $line);

		} elseif (($severity & error_reporting()) !== $severity) {
			return FALSE; // calls normal error handler to fill-in error_get_last()

		} else {
			self::_exceptionHandler(new \FatalErrorException($message, 0, $severity, $file, $line));
		}
	}
}

require_once __DIR__ . '/exceptions.php';