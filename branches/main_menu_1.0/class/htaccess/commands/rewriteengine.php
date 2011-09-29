<?php

class htaccessLineCommandRewriteEngine
	extends htaccessLine {

	function __construct($on = true) {
		$this->initVar('on', XOBJ_DTYPE_INT, intval((bool)$on));
		parent::__construct($this);
	}

	function render() {
		return 'RewriteEngine '.(((bool)$this->getVar('on'))?'On':'Off');
	}

}

?>