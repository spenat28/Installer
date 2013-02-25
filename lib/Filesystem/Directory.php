<?php

namespace Installer\Filesystem;

class Directory extends Node
{
	/**
	 * mkdir
	 */
	public function create($mode)
	{
		if(!$this->exists())
		{
			$this->filesystem->mkdir($this->name, $mode);
			$this->getStats();
			return $this;
		} else {
			return $this;
		}
	}

	/**
	 *
	 * @return boolean
	 */
	public function exists()
	{
		if(is_dir($this->name))
			return TRUE;
		else
			return FALSE;
	}

	//TODO removeContent()
}