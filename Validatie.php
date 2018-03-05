<?php

class Validatie
{
	protected $filters;
	protected $validators;

	public function __construct(array $filters = [], array $validators = [])
	{
		$this->filters = $filters;
		$this->validators = $validators;
	}

	public function isValid(): bool
	{
		
	}
}