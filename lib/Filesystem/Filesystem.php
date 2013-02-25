<?php

namespace Installer\Filesystem;

/**
 * Description of Filesystem
 *
 * @author spenat
 */
class Filesystem extends \Symfony\Component\Filesystem\Filesystem
{
	/**
	 *
	 * @var string Server Runnig as
	 */
	public $user;

	public function __construct() {
		$this->user = $this->determineCurrentUser();
		return $this;
	}

	protected function determineCurrentUser()
	{
		// return posix_getpwuid(posix_geteuid());
		return get_current_user();
	}

	/**
     * Sets access and modification time of file.
     *
     * @param string|array|\Traversable $files A filename, an array of files, or a \Traversable instance to create
     * @param integer                   $time  The touch time as a unix timestamp
     * @param integer                   $atime The access time as a unix timestamp
     *
     * @throws IOException When touch fails
     */
    public function touch($files, $time = null, $atime = null, $mkdir = TRUE)
    {
        if (null === $time) {
            $time = time();
        }

        foreach ($this->toIterator($files) as $file) {
			if($mkdir)
			{
				// create parent directories for file
				$this->createParentDir($file);
			}
            if (true !== @touch($file, $time, $atime)) {
                throw new IOException(sprintf('Failed to touch %s', $file));
            }
        }
    }

	public function createParentDir($node)
	{
		$dir = dirname($node);
		if(!is_dir($dir))
		{
			$this->mkdir($dir);
			$this->createParentDir($dir);
		} else {
			return TRUE;
		}
	}

	/**
     * @param mixed $files
     *
     * @return \Traversable
     */
    private function toIterator($files)
    {
        if (!$files instanceof \Traversable) {
            $files = new \ArrayObject(is_array($files) ? $files : array($files));
        }

        return $files;
    }
}
