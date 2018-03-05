<?php

class Validatie
{
	/*protected $filters;
	protected $validators;*/
	protected $strings;
	protected $numbers;
	public $errorMessage = '';

	public function __construct(array $strings = [], array $numbers = [])
	{
		$this->strings = $strings;
		$this->numbers = $numbers;
	}

	public function isString()
	{
		foreach ($this->strings as $string) {
			if(!is_string($string) || '' === $string) {
				$this->errorMessage = 'You entered an invalid input';
				return $this->errorMessage;
			}

			echo $string;
		}
	}

	public function isNumber()
	{
		foreach ($this->numbers as $number) {
			if(!is_numeric($number) || $number < 0) {
				$this->errorMessage = 'You entered an invalid input';
				return $this->errorMessage;
			}

			echo $number;
		}
	}
}

/*header("Location: index.php");
*/
// TEST CODE

/*$toValidateStrings = ['martino', 'beenham', 'hesp'];
$toValidateNumbers = [5, 1.3, 8, 9.23, 'hesp', -6];
$ToValidate = new Validatie($toValidateStrings, $toValidateNumbers);

echo $ToValidate->isString();
echo '<br>';
echo $ToValidate->isNumber();
/*echo $ToValidate->errorMessage;*/*/