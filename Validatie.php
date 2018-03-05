<?php

require_once('Brood.php');
require_once('Order.php');

class broodValidator extends Brood {

	protected $brood;
	protected $errors;

	public function __construct(Brood $brood)
	{
		$this->brood = $brood;
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
				if(!is_bool($grootte)) {
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
			}
		];
		if(!$validators['Aantal'](getAantalBroodjes())) {
			$this->errors['aantal'] = 'Aantal is niet correct';
			return false;
		}
		if(!$validators['Grootte'](getBaguette())) {
			$this->errors['grootte'] = 'Grootte is niet correct';
			return false;
		}
		if(!$validators['Smos'](getSmos())) {
			$this->errors['smos'] = 'Smos is niet correct';
			return false;
		}
		if(!$validators['Fitness'](getFitness())) {
			$this->errors['fitness'] = 'Fitness is niet correct';
			return false;
		}
		if(!$validators['Type'](getTypeBeleg())) {
			$this->errors['type'] = 'Type is niet correct';
			return false;
		}
	}

	public function getErrors(): array 
	{
		return $this->errors;
	}

}

class orderValidator extends Order {

	protected $order;
	protected $errors:

	public function __construct(Order $order)
	{
		$this->order = $order;
		$this->errors = [];
	}

	public function isValid(): bool
	{
		$validators = [
			
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
		if(!$validators['Naam']($this->order->getNaam())) {
			$this->errors['naam'] = 'Naam is niet correct';
			return false;	
		}
		if(!$validators['Soep']($this->order->getSoep())) {
			$this->errors['soep'] = 'Fout bij het selecteren van soep';
			return false;
		}
		return true;		
	}

	public function getErrors(): array 
	{
		return $this->errors;
	}	
}

