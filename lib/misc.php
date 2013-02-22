<?php

/**
 * Check and reset PHP configuration.
 */
error_reporting(E_ALL | E_STRICT);
@set_magic_quotes_runtime(FALSE); // @ - deprecated since PHP 5.3.0
iconv_set_encoding('internal_encoding', 'UTF-8');
extension_loaded('mbstring') && mb_internal_encoding('UTF-8');
umask(0);
@header('Content-Type: text/html; charset=utf-8'); // @ - headers may be sent
