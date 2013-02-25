<?php

namespace Installer;

class InstallController extends BaseController
{

	public function actionStepFirst()
	{
		$dir = new Directory('config', APP_DIR);
		$this->response->render(TEMPLATES_DIR . '/install/stepFirst.phtml');
	}

	public function actionStepSecond()
	{
		$this->response->render(TEMPLATES_DIR . '/install/stepSecond.phtml');
	}

	/**
	 * Root adresar projektu
	 * @var string
	 */
	protected $appDir;
	/**
	 * Pole potrebnych temp a podobnych adresaru
	 * @var array
	 */
	protected $dirs;
	/**
	 * Pole messages
	 * @var array
	 */
	protected $messages = array();

	/**
	 *
	 * @param type $appDir
	 * @param array $dirs
	 * @return \Installer
	 */
	public function __construct($appDir, array $dirs) {
		$this->dirs = $dirs;
		$this->appDir = $appDir;
		return $this;
	}

	public function checkDirs()
	{
		foreach ($this->dirs as $dir) {
			if(file_exists($this->appDir . '/' . $dir))
				$this->messages[] = '';
			else {
				$this->messages[] = '';
				return FALSE;
			}
			return TRUE;
		}
	}

	public function createDirs()
	{
	}

	public function check()
	{
		$this->checkDirs();

	}

	public function install()
	{
		if(!$this->checkDirs())
			$this->createDirs();
	}
}