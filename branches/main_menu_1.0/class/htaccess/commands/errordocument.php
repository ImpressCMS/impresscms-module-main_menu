<?php

class htaccessLineCommandErrorDocument
	extends htaccessLine {

	function __construct($error, $url) {
		$this->initVar('error', XOBJ_DTYPE_INT, $error);
		$this->initVar('url', XOBJ_DTYPE_TXTBOX, $url);
		parent::__construct($this);
	}
}

?>