<?php

require_once('Brood.php');
require_once('Order.php');
require_once('User.php');
require_once('Supplement.php');

//USERVALIDATOR, OPMERKINGVALIDATOR EN SUPPLEMENT VALIDATOR MOETEN NOG IN broodje_verwerken.php GEIMPLEMENTEERD WORDEN

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
					$this->errors['smos'] = 'Foutieve waarde voor \'Smos\'';
					return false;
				}
				return true;	
			},
			'Fitness' => function($fitness) {
				if(!is_bool($fitness)) {
					$this->errors['fitness'] = 'Foutieve waarde voor \'Fitness\'';
					return false;
				}
				return true;
			},
			'Type' => function($type) {
				if(!is_string($type) || '' === $type) {
					$this->errors['type'] = 'Foutieve waarde voor \'Beleg\'';
					return false;
				}
				return true;
			},
			'Opmerking' => function($opmerking) {
				if(!is_string($opmerking) && !ctype_alnum($opmerking)) {
					$this->errors['opmerking'] = 'Foutieve waarde voor \'opmerking\'';
					return false;
				}
				return true;
			}
		];
		if(!$validators['Aantal']($this->brood->getAantalBroodjes())) {
			$this->errors['aantal'] = 'Aantal is niet correct';
			return false;
		}
		if(!$validators['Grootte']($this->brood->getBaguette())) {
			$this->errors['grootte'] = 'Grootte is niet correct';
			return false;
		}
		if(!$validators['Smos']($this->brood->getSmos())) {
			$this->errors['smos'] = 'Smos is niet correct';
			return false;
		}
		if(!$validators['Fitness']($this->brood->getFitness())) {
			$this->errors['fitness'] = 'Fitness is niet correct';
			return false;
		}
		if(!$validators['Type']($this->brood->getTypeBeleg())) {
			$this->errors['type'] = 'Type is niet correct';
			return false;
		}
		if(!$validators['Opmerking']($this->brood->getOpmerking())) {
			$this->errors['opmerking'] = 'Opmerking is foutief';
			return false;
		}
		return true;
	}

	public function getErrors(): array 
	{
		return $this->errors;
	}

}

class orderValidator extends Order {

	protected $order;
	protected $errors;

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
			},
			'Supplement' => function($supplement) {
				if(!is_bool($supplement)) {
					$this->errors['supplement'] = 'Foute optie voor \'supplement\'';
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
		if(!$validators['Supplement']($this->supplement->getSupplement())) {
			$this->errors['supplement'] = 'Fout bij het selecteren van supplement';
			return false;
		}
		return true;		
	}

	public function getErrors(): array 
	{
		return $this->errors;
	}	
}

class UserValidator extends User {
	protected $user;
	protected $errors;

	function __construct(User $user) {
		$this->user = $user;
		$this->errors = $errors;
	}

	public function isValid() : bool 
	{
		$validators = [
			'email' => function($email) {
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->errors['email_invalid'] = 'Foutieve input voor veld \'e-mail\'';
					return false;
				} 
				return true;
			},
			'naam' => function($naam) {
				if(!ctype_alpha($naam) || '' === $naam) {
					$this->errors['naam_invalid'] = 'Foutieve input voor veld \'naam\'';
					return false;
				}
				return true;
			},
			'voornaam' => function($voornaam) {
				if(!ctype_alnum($voornaam) || '' === $naam) {
					$this->errors['voornaam_invalid'] = 'Foutieve input voor veld \'voornaam\'';
				}
			}

			
		];
		if(!$validators['email']($this->user->getEmail())) {
			$this->errors['email'] = 'Email is niet correct';
			return false;	
		}
		if(!$validators['naam']($this->user->getNaam())) {
			$this->errors['naam'] = 'Naam is niet correct';
			return false;
		}
		if(!$validators['voornaam']($this->user->getVoornaam())) {
			$this->errors['voornaam'] = 'voornaam is niet correct';
			return false;
		}
		return true;	
	}


	public function getErrors(): array 
	{
		return $this->errors;
	}

}

