<?php

class htaccessLineCommandAuthGroupFile
	extends htaccessLine {

	function __construct($file) {
		$this->initVar('file', XOBJ_DTYPE_TXTBOX, $file);
		parent::__construct($this);
	}

}

?>