<?php

class htaccessLineCommandOptions
	extends htaccessLine {

	function __construct() {
		$args = func_get_args();
		$this->initVar('params', XOBJ_DTYPE_ARRAY, $args);
		parent::__construct($this);
	}

	public function getIndexOfOption($option) {
		$array = $this->getVar('params');
		$nr = array_search($option, $array);
		if ($nr!==false) return $nr;
		$nr = array_search('-'.$option, $array);
		if ($nr!==false) return $nr;
		$nr = array_search('+'.$option, $array);
		if ($nr!==false) return $nr;
		return false;
	}

	public function optionExist($option) {
		return (bool)$this->getIndexOfOption($option);
	}

	public function toggleOption($option, $state) {
		$array = $this->getVar('params');
		$index = $this->getIndexOfOption($option);
		$code = ($state)?'+'.$option:'-'.$option;
		if ($index === false) {
			$array[] = $code;
		} else {
			$array[$index] = $code;
		}
		$this->setVar('params', $array);
	}

	public function hasProperty($option, $state) {
		$index = $this->getIndexOfOption($option);
		if ($index === false) return false;
		$array = $this->getVar('params');
		$code = ($state)?'+'.$option:'-'.$option;
		return (($array[$index]==$code) || ($array[$index]==$option));
	}

}

?>