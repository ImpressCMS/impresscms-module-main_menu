<?php

class htaccessLineComment
	extends htaccessLine {

	function __construct($text) {
		$this->initVar('comment', XOBJ_DTYPE_TXTBOX, $text);
		parent::__construct($this);
	}

	function render() {
		return '#' . $this->getVar('comment');
	}

}