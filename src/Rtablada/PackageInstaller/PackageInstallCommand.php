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
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

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

		var_dump($path); die();
	}

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
