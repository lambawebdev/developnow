<?php

namespace App\Services;

class CalculateDestinationTime
{
	const DESTINATION = 350;

	private array $vehicleTypes = ['sport-car', 'truck', 'bike', 'boat'];
	private array $vehiclesSpeed = [150, 60, 100, 50];

	public function calculateTimeToDestination(): void
	{
		foreach ($this->vehicleTypes as $vehicleNumber => $vehicleType) {
			if ($vehicleType === 'boat') {
				print((self::DESTINATION / $this->vehiclesSpeed[$vehicleNumber]) + 0.25);

				continue;
			}

			print(self::DESTINATION / $this->vehiclesSpeed[$vehicleNumber]);
		}
	}
}