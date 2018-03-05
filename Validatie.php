<?php

/*class Validatie
{
	protected $filters;
	protected $validators;
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
}*/

/*header("Location: index.php");
*/
// TEST CODE

/*$toValidateStrings = ['martino', 'beenham', 'hesp'];
$toValidateNumbers = [5, 1.3, 8, 9.23, 'hesp', -6];
$ToValidate = new Validatie($toValidateStrings, $toValidateNumbers);

echo $ToValidate->isString();
echo '<br>';
echo $ToValidate->isNumber();
/*echo $ToValidate->errorMessage;*/

class orderValidator {

	protected $order;
	protected $errors:

	public function __construct($order)
	{
		$this->order = $order;
		$this->errors = [];
	}

	public function isValid(): bool
	{
		$validators = [
			'Aantal' => function($aantal) {
				if(!is_int($aantal) && !ctype_digit($aantal)) {
					$this->errors['aantal_digit'] = 'Aantal is geen getal';
					return false;
				}
				if(($aantal < 0) || ($aantal > 1000)) {
					$this->errors['aantal-range'] = 'Aantal mag niet kleiner zijn dan 0 of groter dan 1000';
					return false;
				}
				return true;
			},
			'Grootte' => function($grootte)	{
				if(!is_string($grootte) && !ctype_alpha($grootte)) {
					$this->errors['grootte'] = 'Foutieve waarde voor \'Grootte\'';
					return false;
				}
				return true;
			},
			'Smos' => function($smos) {
				if(!is_bool($smos)) {
					$this->errors['smos'] = 'Geen optie gekozen voor \'Smos\'';
					return false;
				}
				return true;	
			},
			'Fitness' => function($fitness) {
				if(!is_bool($fitness)) {
					$this->errors['fitness'] = 'Geen optie gekozen voor \'Fitness\'';
					return false;
				}
				return true;
			},
			'Type' => function($type) {
				if(!is_string($type) || '' === $type) {
					$this->errors['type'] = 'Foutieve waarde voor \'Type\'';
					return false;
				}
				return true;
			},
			'Naam' => function($naam) {
				if(!is_string($naam) || '' === $naam) {
					$this->errors['naam'] = 'Geef uw naam op aub.';
					return false;
				}
				return true;
			},
			'Soep' => function($soep) {
				if(!is_bool($soep)) {
					$this->errors['soep'] = 'Geen optie gekozen voor \'soep van de dag\'';
					return false;
				}
				return true;
			}
		];
	}

	public function getErrors(): array 
	{
		return $this->errors;
	}	
}
