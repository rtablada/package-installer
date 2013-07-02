<?php namespace Rtablada\PackageInstaller;

use Symfony\Component\Console\Tester\CommandTester;
use Packagist\Api\Result\Factory;
use Mockery as m;

class PackageSearchCommandTest extends \PHPUnit_Framework_Testcase
{
	public function setup()
	{
		$factory = new Factory;
		$this->results = json_decode(file_get_contents(__DIR__.'/stubs/results.json'), true);
		$this->results = $factory->create($this->results);
	}

	public function testSearchesForPackages()
	{
		$packagist = m::mock('Packagist\Api\Client');

		$tester = new CommandTester(new PackageSearchCommand($packagist));

		$packagist->shouldReceive('search')->once()
			->with('rtablada', array('tags' => 'lpm'))
			->andReturn($this->results);

		$tester->execute(array('query' => 'rtablada'));

		$this->assertContains('rtablada', $tester->getDisplay());
	}

	public function teardown()
	{
		m::close();
	}
}
