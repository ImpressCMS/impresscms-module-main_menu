<?php

class htaccessLineCommandAddHandler
	extends htaccessLine {

	function __construct($type, $extentions) {
		$this->initVar('type', XOBJ_DTYPE_TXTBOX, $mimeType);
		$this->initVar('extentions', XOBJ_DTYPE_ARRAY, $extentions);
		parent::__construct($this);
	}

}

?>