<?php
namespace School;

class Student {

	protected $firstName;
	protected $lastName;
	protected $slug;

	public function __construct() {
	}

	public function getFullName() {
		return "$this->FirstName $this->LastName";
	}
	
	public function getSlug() {
		return strtolower(str_replace(' ', '-', trim($this->getFullName())));
	}
	
}
