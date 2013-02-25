<?php

namespace Installer\Filesystem;

use Installer\Object;

/**
 * Description of Node
 *
 * @author spenat
 */
class Node extends Object {
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
	protected $mode;
	protected $owner;

	protected $exists;

	protected $filesystem;

	public function __construct(\Installer\Filesystem\Filesystem $filesystem, $name)
	{
		$this->filesystem = $filesystem;
		$this->name = $name;
		$this->getStats();
		return $this;
	}

	/**
	 *
	 * @return boolean
	 */
	public function exists()
	{
		if(file_exists($this->name))
			return TRUE;
		else
			return FALSE;
	}

	public function chmod($mode, $umask = 0000)
	{
		if($this->exists())
		{
			$this->mode = substr('0' . decoct($mode & ~$umask), -4);
			$this->filesystem->chmod($this->name, $mode, $umask);
		} else {
			throw new \FileNotFoundException('File ' . $this->name . 'not found.');
		}
		return $this;
	}

	public function chown($user)
	{
		$this->owner = $user;
		$this->filesystem->chown($this->name, $user);
		return $this;
	}

	public function remove()
	{
		$this->exists = FALSE;
		return $this->filesystem->remove($this->name);
	}

	public function isWriteable()
	{
		return is_writable($this->name);
	}

	protected function getStats()
	{
		if($this->exists())
		{
			$this->mode = $this->getMode();
			$this->owner = posix_getpwuid(fileowner($this->name));
			$this->owner = $this->owner['name'];
		}
	}

	public function getExists()
	{
		if($this->exists)
			return $this->exists;
		else
			return $this->exists();
	}

	/**
	 *
	 * @return int/bool 4-number mode of file
	 */
	public function getMode()
	{
		if($this->mode)
			return $this->mode;
		if($this->exists())
		{
			$this->mode = substr(decoct(@fileperms($this->name)), -4);
			return $this->mode;
		} else
			false;
	}

	protected function getDirname()
	{
		return dirname($this->name);
	}

	protected function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}
}
