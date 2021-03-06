<?php declare(strict_types = 1);

namespace Adeira\Connector\Devices\DomainModel\WeatherStation;

use Adeira\Connector\Devices\DomainModel\{
	Humidity,
	PhysicalQuantities,
	Pressure,
	Temperature,
	Wind
};

/**
 * This is entity without mapping. Mapping is infrastructure detail.
 *
 * @see Infrastructure/Persistence/Doctrine/Mapping/Adeira.Connector.Devices.DomainModel.WeatherStation.WeatherStationRecord.dcm.xml
 */
final class WeatherStationRecord
{

	/**
	 * @var WeatherStationRecordId
	 */
	private $id;

	/**
	 * @var WeatherStationId
	 */
	private $weatherStationId;

	/**
	 * @var \Adeira\Connector\Devices\DomainModel\PhysicalQuantities
	 */
	private $physicalQuantities;

	/**
	 * @var \DateTimeImmutable
	 */
	private $creationDate;

	public function __construct(
		WeatherStationRecordId $recordId,
		WeatherStationId $weatherStationId,
		PhysicalQuantities $quantities,
		\DateTimeImmutable $creationDate
	) {
		$this->id = $recordId;
		$this->weatherStationId = $weatherStationId;
		$this->physicalQuantities = $quantities;
		$this->creationDate = $creationDate;
	}

	public function id(): WeatherStationRecordId
	{
		return $this->id;
	}

	public function weatherStationId(): WeatherStationId
	{
		return $this->weatherStationId;
	}

	public function pressure(): Pressure
	{
		return $this->physicalQuantities->pressure();
	}

	public function temperature(): Temperature
	{
		return $this->physicalQuantities->temperature();
	}

	public function humidity(): Humidity
	{
		return $this->physicalQuantities->humidity();
	}

	public function wind(): Wind
	{
		return $this->physicalQuantities->wind();
	}

	public function creationDate(): \DateTimeImmutable
	{
		if ($this->creationDate instanceof \DateTime) {
			return \DateTimeImmutable::createFromMutable($this->creationDate);
		}
		return $this->creationDate;
	}

}
