<?php namespace Rtablada\PackageInstaller;

/**
 * Provider Wrapper For Package Provider
 */
class Provider
{
	/**
	 * Array of ServiceProviders provided by the package
	 *
	 * @var array
	 */
	public $serviceProviders = array();

	/**
	 * Array of Aliases provided by the package
	 *
	 * @var array
	 */
	public $aliases = array();

	/**
	 * Create a new Provider Instance
	 * @param stdObj $obj
	 */
	public function __construct($obj = null)
	{
		if ($obj) {
			$this->setObjectValues($obj);
		}
	}

	public function setObjectValues($obj)
	{
		$this->serviceProviders = $obj->serviceProviders;
		$this->aliases = $obj->serviceProviders;
	}

	/**
	 * Creates a Provider Instance from JSON string
	 * @param  string $string JSON Provider
	 * @return Provider
	 */
	public function buildFromJson($string)
	{
		$obj = json_decode($string);

		return new static($obj);
	}
}
