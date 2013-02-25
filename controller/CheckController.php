<?php

namespace Installer;

use Neon;
use Installer\Filesystem\Directory;

/**
 * Description of CheckController
 *
 * @author spenat
 */
class CheckController extends BaseController {

	public function actionDefault()
	{

		global $requirements;

		$filesystem = new Filesystem\Filesystem();

		$directories = array();
		foreach ($requirements['writeableDirectories'] as $dir)
		{
			$directory = $directories[] = new Filesystem\Directory($filesystem, APP_DIR . '/' . $dir);
		}

		$files = array();
		foreach ($requirements['existingFiles'] as $file)
		{
			$file = $files[] = new Filesystem\File($filesystem, APP_DIR . '/'. $file);
		}

		$this->response->data->files = $files;
		$this->response->data->directories = $directories;
		$this->response->render(TEMPLATES_DIR . '/check/default.phtml');
	}
}
