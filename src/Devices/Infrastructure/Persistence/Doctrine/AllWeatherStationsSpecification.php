<?php declare(strict_types = 1);

namespace Adeira\Connector\Devices\Infrastructure\Persistence\Doctrine;

use Adeira\Connector\Authentication\DomainModel\Owner\Owner;
use Adeira\Connector\Common\Infrastructure\DomainModel\Doctrine\Specification\{
	AndX, ISpecification
};
use Adeira\Connector\Devices\DomainModel\WeatherStation\WeatherStation;
use Adeira\Connector\Devices\DomainModel\WeatherStation\WeatherStationId;
use Doctrine\ORM;

final class AllWeatherStationsSpecification implements ISpecification
{

	private $specification;

	private $limit;

	public function __construct(Owner $owner, int $limit = NULL, WeatherStationId $fromWeatherStationId = NULL)
	{
		$andSpecifications = [
			new FilterOwner($owner),
		];
		if ($fromWeatherStationId !== NULL) {
			$andSpecifications[] = new FilterWeatherStationsAfter($fromWeatherStationId);
		}
		$this->specification = new AndX(...$andSpecifications);
		$this->limit = $limit;
	}

	public function match(ORM\QueryBuilder $qb, string $dqlAlias): ORM\Query\Expr\Andx
	{
		$qb->setMaxResults($this->limit);
		return $this->specification->match($qb, $dqlAlias);
	}

	public function isSatisfiedBy(string $candidate): bool
	{
		return $candidate === WeatherStation::class;
	}

}
