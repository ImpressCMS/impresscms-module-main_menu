<?php

class htaccessLineCommandAddType
	extends htaccessLine {

	function __construct($mimeType, $extention) {
		$this->initVar('mime-type', XOBJ_DTYPE_TXTBOX, $mimeType);
		$this->initVar('extentions', XOBJ_DTYPE_ARRAY, $extention);
		parent::__construct($this);
	}

}

?>