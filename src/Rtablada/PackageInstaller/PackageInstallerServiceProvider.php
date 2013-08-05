<?php namespace Rtablada\PackageInstaller;

use Illuminate\Support\ServiceProvider;

class PackageInstallerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerInstall();
		$this->registerRequire();
		$this->registerSearch();
		$this->registerCommands();
	}

	protected function registerInstall()
	{
		$this->app['package.install'] = $this->app->share(function($app)
        {
        	$providerCreator = new ProviderCreator($app['files'], new Provider);
        	$packageInstaller = new PackageInstaller($app['files'], $app['config']);
        	return new PackageInstallCommand($providerCreator, $packageInstaller);
        });
	}

	protected function registerRequire()
	{
		$this->app['package.require'] = $this->app->share(function($app)
        {
            return new PackageRequireCommand;
        });
	}

	protected function registerSearch()
	{
		$this->app['package.search'] = $this->app->share(function($app)
        {
            return new PackageSearchCommand(new \Packagist\Api\Client);
        });
	}

	protected function registerCommands()
	{
		$this->commands('package.install', 'package.require', 'package.search');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
