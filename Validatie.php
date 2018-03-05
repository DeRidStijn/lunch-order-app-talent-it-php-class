<?php

class Validatie
{
	/*protected $filters;
	protected $validators;*/
	protected $strings;
	protected $numbers;

	public function __construct(array $strings = [], array $numbers = [])
	{
		$this->strings = $strings;
		$this->numbers = $numbers;
	}

	public function isValid(): bool
	{
		foreach ($strings as $string) {
			$validString = false;
			if(is_string($string) && '' !== $string) {
				$validString = true;
			}
			return $validString;	
		}
		foreach ($numbers as $number) {
			$validNumber = false;
			if(is_numeric($number) && $number >= 0) {
				$validNumber = true;
			}
			return $validNumber;
		}
	}
}