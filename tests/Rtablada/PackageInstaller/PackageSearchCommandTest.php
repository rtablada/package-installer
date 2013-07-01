<?php namespace Rtablada\PackageInstaller;

use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class PackageSearchCommandTest extends \PHPUnit_Framework_Testcase
{
	public function testSearchesForPackages()
	{
		$packagist = m::mock('Packagist\Api\Client');
		// $packagist->shouldReceive('search')->once();

		$tester = new CommandTester(new PackageSearchCommand(new \Packagist\Api\Client));

		$tester->execute(['query' => 'rtablada']);

		$this->assertContains('rtablada', $tester->getDisplay());
	}

	public function tearDown()
	{
		m::close();
	}
}
