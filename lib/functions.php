<?php

/**
 * Dump HTML formated output for variable
 *
 * @param mixed $var
 * @return mixed
 */
function dump($var)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	return $var;
}

/**
 * Shortcut for dump
 *
 * @param    mixed
 * @param    mixed $var, ...       optional additional variable(s) to dump
 * @return   mixed                 the first dumped variable
 */
function d($var)
{
	foreach (func_get_args() as $var) dump($var);
	return func_get_arg(0);
}