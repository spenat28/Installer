<?php

namespace Installer;

abstract class BaseController extends \Installer\Object
{
	/** @var \_Request */
	protected $request;

	/** @var \_Response */
	protected $response;

	/** @var \_App */
	protected $app;

	/**
	 *
	 * @param \_Request $request
	 * @param \_Response $response
	 * @param \_App $app
	 */
	public function __construct(\_Request $request,  \_Response $response, \_App $app) {
		list($this->request, $this->response, $this->app) = func_get_args();

		// here we will store data for view
		$this->response->data = new \stdClass;

		// here we will store components for view
		$this->response->components = new \stdClass;

		self::startup();
	}

	public static function startup()
	{}
}