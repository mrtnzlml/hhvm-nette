<?php declare(strict_types = 1);

namespace Adeira\Connector\PhysicalUnits\Pressure\Units;

use Adeira\Connector\PhysicalUnits\IUnit;

class Atm implements IUnit
{

	public function unitCode(): string
	{
		return 'atm';
	}

	public function getConversionTable(): array
	{
		return [
			'bar' => 101325 / 1e5, //exact
			'Pa' => 101325, //exact
			'Torr' => 760, //exact
		];
	}

}
