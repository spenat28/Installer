<?php

namespace Installer\Filesystem;

/**
 * Description of File
 *
 * @author spenat
 */
class File extends Node {

	protected $content;

	public function getContent()
	{
		if($this->content)
			return $this->content;
		elseif($this->exists())
		{
			return file_get_contents($this->name);
		} else {
			throw new \FileNotFoundException($this->name . 'Not found.');
		}
	}

	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

	public function save()
	{
		if(!$this->exists())
			$this->filesystem->touch($this->name);
		return file_put_contents($this->name, $this->content);
	}
}
