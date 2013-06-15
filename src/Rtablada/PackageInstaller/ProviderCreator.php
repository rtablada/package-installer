<?php namespace Rtablada\PackageInstaller;

use Illuminate\Filesystem\Filesystem as File;

class ProviderCreator
{
	/**
	 * Instance of the File class
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected $file;

	/**
	 * Creates the ProviderCreator Instance
	 *
	 * @param Illuminate\Filesystem\Filesystem     $file
	 * @param Provider $provider
	 */
	function __construct(File $file, Provider $provider)
	{
		$this->file = $file;
		$this->provider = $provider;
	}

	/**
	 * Creates a Provider Instance from a file path
	 * @param  string $path
	 * @return Provider
	 */
	public function buildProviderFromJsonFile($path)
	{
		if ($this->file->exists($path)) {
			$contents = $this->file->get($path);
			$contents = $this->createValidJsonWithSlashes($contents);
			return $this->provider->buildFromJson($contents);
		}

		return null;
	}

	/**
	 * Replaces single slash with dual slash for valid JSON
	 * @param  string $string
	 * @return string
	 */
	protected function createValidJsonWithSlashes($string)
	{
		return preg_replace("~(\w)\\\(\w)~", "$1\\\\\\\\$2", $string);
	}
}
