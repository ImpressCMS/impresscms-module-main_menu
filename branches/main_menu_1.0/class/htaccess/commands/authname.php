<?php

class htaccessLineCommandAuthName
	extends htaccessLine {

	function __construct($text) {
		$this->initVar('text', XOBJ_DTYPE_TXTBOX, $text);
		parent::__construct($this);
	}

}

?>