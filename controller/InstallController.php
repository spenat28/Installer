<?php

namespace Installer;

class InstallController extends BaseController
{
	public function actionStepFirst()
	{
		$this->response->render(TEMPLATES_DIR . '/install/stepFirst.phtml');
	}

	public function actionStepSecond()
	{
		$this->response->render(TEMPLATES_DIR . '/install/stepSecond.phtml');
	}
}