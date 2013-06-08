Plan of attack
===

Commands
- Package:require
	1. passthru("composer require {$packageName}")
- Package:install
	1. $this->call('package:require', array('name' => $packageName))
	2. $path = $this->getPackagePath()
		1. // Parse $packageName for segments
		2. // $package $packageSegments[1] to studly case from '-' delimited
		3. $vendor = ucwords($packageSegments[0])
		4. $path = base_path() . "vendor/{$packageSegment[0]}/{$packageSegment}/provides.json"
	3. $provider = $this->builder->newInstanceFromJsonFile($path)
	4. $this->installer->updateConfigurations($package)
		1. $this->updateServiceProviders($package->serviceProviders)
			1. $contents = $this->getConfigContents()
			2. $configProviders = $this->config->get('app.providers');
			3. foreach($providers as $provider) $configProviders . "\n\t\t" . $provider
			4. $this->contentsCache = str_replace($this->laravel['config']['app.key'], $key, $contents);
		2. $this->updateAliases($package->aliases)
			1. $contents = $this->getConfigContents()
			2. $configProviders = $this->config->get('app.alias');
			3. foreach($providers as $provider) $configProviders . "\n\t\t" . $provider
			4. $contents = str_replace($this->laravel['config']['app.key'], $key, $contents);
		3. $this->getConfigContents()
			1. if(!isset($this->contentsCache)) $this->contentsCache = $this->file->get($this->configPath)
			2. return $this->contentsCache
		4. $this->putConfigFile()
			1. $this->file->put($this->configPath, $this->getConfigContents())
		5. $this->configPath = app_path().'/config/app.php'
