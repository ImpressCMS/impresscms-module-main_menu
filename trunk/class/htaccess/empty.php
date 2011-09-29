<?php

class htaccessLineEmpty 
	extends htaccessLine {

	function __construct() {
		parent::__construct($this);
	}	

	public function render() {
		return '';
	}
	
}