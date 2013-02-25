<?php

namespace Installer\Component;

use Installer\Object;

/**
 * Description of Form
 *
 * @author Stepan Macha <spenat28@gmail.com>
 */
class Form extends Object {

	protected $template;

	public function __construct($template) {
		$this->template = $template;
	}

	public function render()
	{
		require_once $this->template;
	}
}
