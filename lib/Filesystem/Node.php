<?php

namespace Installer\Filesystem;

/**
 * Description of Node
 *
 * @author spenat
 */
class Node {
	protected $filesystem;

	public function __construct(\Installer\Filesystem\Filesystem $filesystem)
	{
		$this->filesystem = $filesystem;
	}
}
