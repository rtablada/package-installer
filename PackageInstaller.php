<?php namespace Rtablada\PackageInstaller;

use Illuminate\Filesystem\Filesystem;
use \Illuminate\Foundation\Application;

/**
* Installs a packages provided ServiceProviders and Aliases to config/app.php
*/
class PackageInstaller
{
	/**
	 * Instance of the File class
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected $file;

	/**
	 * Creates the PackageInstaller Instance
	 *
	 * @param Illuminate\Filesystem\Filesystem $file
	 */
	public function __construct(Application $app, File $file, Provider $provider)
	{
		$this->app = $app;
		$this->file = $file;
		$this->provider = $provider;
	}

	public function installPackage($packageName)
	{
		// Get path to provides.json
		// Get the provides.json
		// Parse provides.json into Provider
		// Install Service Providers
		$this->installServiceProviders($provider->serviceProviders);
		// Install Aliases
		$this->installAliases($provider->aliases);
	}

	public function installServiceProviders(array $serviceProviders)
	{

	}
}
