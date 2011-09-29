<?php

class htaccessLineCommandAuthType
	extends htaccessLine {

	function __construct($type = 'Basic') {
		$this->initVar('type', XOBJ_DTYPE_TXTBOX, $type);
		parent::__construct($this);
	}

}

?>