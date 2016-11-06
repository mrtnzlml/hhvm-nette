<?php declare(strict_types = 1);

namespace Adeira\Connector\GraphQL\Exceptions;

class InterfaceIsNotValidObjectType extends \Exception
{

	public function __construct(string $className)
	{
		parent::__construct("$className should be instance of " . \Adeira\Connector\GraphQL\IInterface::class);
	}

}
