<?php

namespace App\Services;

class TransformArrayService
{
	function transformedArray(array $inputArray) : array
	{
		$outputArray = array_filter($inputArray);
		$zeroCounter = 0;

		foreach ($inputArray as $arrayItem) {
			if ($arrayItem === 0) {
				$zeroCounter++;

				if ($zeroCounter % 2 !== 0) {
					array_unshift($outputArray, $arrayItem);

				} else {
					$outputArray[] = $arrayItem;
				}
			}
		}

		return $outputArray;
	}
}