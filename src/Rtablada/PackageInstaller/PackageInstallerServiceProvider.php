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
		$this->registerCommands();
	}

	protected function registerInstall()
	{
		$this->app['package.install'] = $this->app->share(function($app)
        {
        	$providerCreator = new ProviderCreator($this->app['files'], new Provider);
        	return new PackageInstallCommand($providerCreator);
        });
	}

	protected function registerRequire()
	{
		$this->app['package.require'] = $this->app->share(function($app)
        {
            return new PackageRequireCommand;
        });
	}

	protected function registerCommands()
	{
		$this->commands('package.install', 'package.require');
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
