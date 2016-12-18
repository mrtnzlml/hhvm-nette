<?php declare(strict_types = 1);

namespace Adeira\Connector\Common\Infrastructure\Application\Service;

class DummySession implements \Adeira\Connector\Common\Application\Service\ITransactionalSession
{

	public function executeAtomically(callable $operation)
	{
		return $operation();
	}

}