<?php

/**
 * @file FilePreviewForm.inc.php
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Copyright (c) 2023 Universidad Nacional de Lanus
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FilePreviewForm
 * @ingroup plugins_generic_filePreview
 *
 * @brief Form for registered users to preview files
 */

import('lib.pkp.classes.form.Form');

class FilePreviewForm extends Form {

	/** @var $contextId int */
	var $contextId;

	/** @var $plugin object */
	var $plugin;

	/**
	 * Constructor
	 * @param $plugin object
	 * @param $contextId int
	 */
	function __construct($plugin, $contextId, $args) {
		$this->contextId = $contextId;
		parent::__construct($plugin->getTemplateResource('filePreview.tpl'));

	}

	/**
	 * Initialize form data.
	 */
	function initData() {
		$contextId = $this->contextId;
		$plugin =& $this->plugin;
	}

	/**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		return parent::fetch($request, $template, $display);
	}


}

