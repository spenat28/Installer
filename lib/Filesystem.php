<?php

/**
 * Description of Filesystem
 *
 * @author spenat
 */
class Filesystem {
	/**
	 *
	 * @var string Server Runnig as
	 */
	protected $user;

	public function __construct() {
		$this->user = $this->determineCurrentUser();
		return $this;
	}

	protected function determineCurrentUser()
	{
		// return posix_getpwuid(posix_geteuid());
		return get_current_user();
	}
}
