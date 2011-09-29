<?php

class htaccessLineCommandAuthUserFile
	extends htaccessLine {

	function __construct($file) {
		$this->initVar('file', XOBJ_DTYPE_TXTBOX, $file);
		parent::__construct($this);
	}

}

?>