<?php

class Validatie
{
	/*protected $filters;
	protected $validators;*/
	protected $strings;
	protected $numbers;
	public $validString;
	public $validNumber;
	public $errorMessage = '';

	public function __construct(array $strings = [], array $numbers = [])
	{
		$this->strings = $strings;
		$this->numbers = $numbers;
	}

	public function isString()
	{
		foreach ($this->strings as $string) {
			$validString = false;
				
			echo $string;	

			if(is_string($string) && '' !== $string) {
				$validString = true;
			} else {
				$this->errorMessage = 'You entered an invalid input';
				return $this->errorMessage;
			}
		}
	}

	public function isNumber()
	{
		foreach ($this->numbers as $number) {
			$validNumber = false;

			echo $number;

			if(is_numeric($number) && $number >= 0) {
				$validNumber = true;
			} else {
				$this->errorMessage = 'You entered an invalid input';
				return $this->errorMessage;
			}
		}
	}
}

header("Location: index.php");

/*// TEST CODE

$toValidateStrings = ['martino', 'beenham', 'hesp'];
$toValidateNumbers = [5, 1.3, 8, 9.23, 'hesp', -6];
$ToValidate = new Validatie($toValidateStrings, $toValidateNumbers);

echo $ToValidate->isString();
echo '<br>';
echo $ToValidate->isNumber();
/*echo $ToValidate->errorMessage;*/*/