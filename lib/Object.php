<?php

namespace Installer;

/**
 * Description of Object
 *
 * @author spenat
 */
class Object {

	/**
	 * Magic getter
	 * @param type $varName
	 * @return type
	 */
	public function __get($varName)
    {
		$varNameGetter = 'get' . ucfirst($varName);
		if(method_exists($this, $varNameGetter))
			return call_user_func(array($this, $varNameGetter));
		else
			throw new \AccessingProtectedVariableException();
    }

    /*
	public function __set($varName,$varValue)
    {
    }
	 *
	 */

}
