<?php

/**
 * Description of Helpers
 *
 * @author spenat
 */
class Template {

	// Helpers ----------

	public static function mklink($controller = NULL, $action = NULL)
	{
		$link = ROOT_PATH;
		if($controller)
			$link .= '/' . $controller;
		if($action)
			$link .= '/' . $action;
		return $link;
	}

	/**
	 * Echo link
	 * @param string $controller
	 * @param string $action
	 * @return string
	 */
	public static function link($controller = NULL, $action = NULL)
	{
		$link = static::mklink($controller, $action);
		echo $link;
		return $link;
	}

	public static function a($text, $controller = NULL, $action = NULL)
	{
		$link = static::mklink($controller, $action);
		echo "<a href='$link' title='$text'>$text</a>";
	}
}
