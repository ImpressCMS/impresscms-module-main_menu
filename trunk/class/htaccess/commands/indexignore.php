<?php

class htaccessLineCommandIndexIgnore
	extends htaccessLine {

	function __construct() {
		$args = func_get_args();
		$this->initVar('params', XOBJ_DTYPE_ARRAY, $args);
		parent::__construct($this);
	}

}

?>