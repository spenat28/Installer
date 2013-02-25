<?php

namespace Installer;

class Directory
{
	const	MODE_PUBLIC = 0777,
			MODE_NORMAL = 0755,
			MODE_PROTECTED = 0666,
			MODE_PRIVATE = 0640;

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
	public function __construct($name, $dirname)
	{
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