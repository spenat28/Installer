<?php

namespace Installer\Filesystem;

class Directory extends Node
{
	const	MODE_DIR_WRITEABLE_ALL = 0777, // for temps, logs, ...
			MODE_DIR_WRITEABLE_OWNER = 0700,
			MODE_DIR_WRITEABLE = 0755, // standard
			MODE_DIR_READ_ALL = 0555,
			MODE_DIR_READ_OWNER = 0500,

			MODE_FILE_EXECUTABLE_ALL = 0777,
			MODE_FILE_WRITEABLE_ALL = 0666,
			MODE_FILE_WRITEABLE_OWNER = 0600,
			MODE_FILE_READ_ALL = 0444,
			MODE_FILE_READ_OWNER = 0400;

	protected $name;
	/**
	 *
	 * @var string parent dir name
	 */
	protected $dirname;
	protected $path;
	protected $mode;
	protected $owner;

	/**
	 *
	 * @param string $name
	 * @param string $path
	 * @return \Installer\Directory
	 */
	public function __construct(Filesystem $filesystem, $name, $dirname)
	{
		parent::__construct($filesystem);

		$this->name = $name;
		$this->dirname = $dirname;
		$this->path = $this->dirname . '/' . $this->name;
		if($this->exists())
		{
			$this->mode = $this->mode();
			$this->owner = posix_getpwuid(fileowner($this->path));
			$this->owner = $this->owner['name'];
		}
		return $this;
	}

	/**
	 * mkdir
	 */
	public function create($mode)
	{
		if(!$this->exists())
		{
			@mkdir($this->path, $mode);
		} else {
			return FALSE;
		}
	}

	/**
	 *
	 * @return boolean
	 */
	public function exists()
	{
		if(is_dir($this->path))
			return TRUE;
		else
			return FALSE;
	}

	public function chmod($mode)
	{
		@chmod($this->path, $mode);
	}

	public function chown($user)
	{
		@chown($this->path, $user);
	}

	/**
	 *
	 * @return int 4-number mode of file
	 */
	public function mode()
	{
		return substr(decoct(@fileperms($this->path)), -4);
	}
}