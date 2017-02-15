<?php declare(strict_types = 1);

namespace Adeira\Connector\Devices\DomainModel\WeatherStation;

use Doctrine\Common\Collections\ArrayCollection;

interface IAllWeatherStationSeries
{

	public function all(): ArrayCollection;

}