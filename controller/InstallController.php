<?php

namespace Installer;

use Installer\Filesystem\Directory;

class InstallController extends BaseController
{

	public function actionStepFirst()
	{
		global $requirements;

		$filesystem = new Filesystem\Filesystem();

		$directories = array();
		foreach ($requirements['writeableDirectories'] as $dir)
		{
			$directory = $directories[] = new Filesystem\Directory($filesystem, APP_DIR . '/' . $dir);
			if(!$directory->exists())
				$directory->create(Directory::MODE_DIR_WRITEABLE_ALL);
			elseif(!$directory->isWriteable())
				$directory->chmod(Directory::MODE_DIR_WRITEABLE_ALL);
		}

		$this->response->data->directories = $directories;

		$this->response->render(TEMPLATES_DIR . '/install/stepFirst.phtml');
	}

	public function actionStepSecond()
	{
		//configForm
		$this->response->components->configForm = $this->createConfigForm();

		// form sended
		if($this->request->param('send'))
		{
			global $requirements;

			$filesystem = new Filesystem\Filesystem();

			$data = array(
				'sever' => $this->request->param('server'),
				'database' => $this->request->param('database'),
				'user' => $this->request->param('user'),
				'password' => $this->request->param('password')
			);


			$files = array();
			foreach ($requirements['existingFiles'] as $fileName)
			{
				$file = $files[] = new Filesystem\File($filesystem, APP_DIR . '/'. $fileName);
				//copy files from requirements folder to application folder
				if(substr($fileName, -4) === 'neon')
				{
					// create neon file content from template
					// create new file instead of copying
					$templateFile = new Filesystem\File($filesystem, REQUIREMENTS_DIR . '/'. $fileName);
					$neon = $this->createConfigNeon($data, $templateFile);
					$file->setContent($neon)->save();
				} else
					$filesystem->copy(REQUIREMENTS_DIR . '/' . $fileName, $file);
			}

			$this->response->flash('Requested files was created.', 'success');
			$this->response->data->files = $files;

		}

		$this->response->render(TEMPLATES_DIR . '/install/stepSecond.phtml');
	}

	protected function createConfigNeon(array $data, Filesystem\File $templateFile)
	{
		// return neon content
		$content = $templateFile->getContent();
		$neon = \Neon::decode($content);
		$neon['parameters']['database']['username'] = $data['user'];
		$neon['parameters']['database']['database'] = $data['database'];
		$neon['parameters']['database']['password'] = $data['password'];
		return \Neon::encode($neon);
	}

	protected function createConfigForm()
	{
		return new Component\Form(TEMPLATES_DIR . '/component/form/configForm.phtml');
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