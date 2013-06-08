<?php namespace Rtablada\PackageInstaller;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PackageInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'package:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs a package and sets configuration.';

	/**
	 * The ProviderCreator instance
	 *
	 * @var ProviderCreator
	 */
	protected $providerCreator;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(ProviderCreator $providerCreator, PackageInstaller $installer)
	{
		parent::__construct();

		$this->providerCreator = $providerCreator;
		$this->installer = $installer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$packageName = $this->argument('packageName');
		// Calls composer require
		$this->call('package:require', compact('packageName'));

		$path = $this->getPackagePath($packageName);
		$provider = $this->providerCreator->buildProviderFromJsonFile($path);

		if (is_null($provider)) {
			return $this->comment('This package has no provides.json file.');
		}

		$this->installer->updateConfigurations($provider);
	}

	/**
	 * Returns path to provides.json for installed package
	 *
	 * @param  string $packageName
	 * @return string
	 */
	protected function getPackagePath($packageName)
	{
		return base_path() . "/vendor/{$packageName}/provides.json";
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('packageName', InputArgument::REQUIRED, 'Name of the composer package to be installed.'),
		);
	}

}
