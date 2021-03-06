<?php declare(strict_types = 1);

namespace Adeira\Connector\Devices\Application\Service\WeatherStation;

use Adeira\Connector\Authentication\DomainModel\User\UserId;
use Adeira\Connector\Authentication\Infrastructure\DomainModel\Owner\UserIdOwnerService;
use Adeira\Connector\Devices\DomainModel\WeatherStation\{
	IAllWeatherStations, WeatherStation, WeatherStationId
};

final class ViewSingleWeatherStation
{

	/**
	 * @var IAllWeatherStations
	 */
	private $allWeatherStations;

	/**
	 * @var \Adeira\Connector\Authentication\Infrastructure\DomainModel\Owner\UserIdOwnerService
	 */
	private $ownerService;

	public function __construct(IAllWeatherStations $allWeatherStations, UserIdOwnerService $ownerService)
	{
		$this->allWeatherStations = $allWeatherStations;
		$this->ownerService = $ownerService;
	}

	public function execute(UserId $userId, WeatherStationId $weatherStationId): WeatherStation
	{
		$owner = $this->ownerService->existingOwner($userId);
		return $this->allWeatherStations->withId($owner, $weatherStationId)->hydrateOne();
	}

}
