<?php

/**
 * @file FilePreviewForm.inc.php
 *
 * Copyright (c) 2015-2019 University of Pittsburgh
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
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
	function __construct($plugin, $contextId) {
		$this->contextId = $contextId;
		$this->plugin = $plugin;
		parent::__construct($plugin->getTemplateResource('filePreview.tpl'));

	}

	/**
	 * Initialize form data.
	 */
	function initData() {
		$contextId = $this->contextId;
		$plugin =& $this->plugin;
		$this->_data = array();
	}


	/**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$contextId = $request->getContext()->getId();
		//$clientId = $this->plugin->getSetting($contextId, 'orcidClientId');
		//$clientSecret = $this->plugin->getSetting($contextId, 'orcidClientSecret');

		$templateMgr = TemplateManager::getManager($request);
		//$aboutUrl = $request->getDispatcher()->url($request, ROUTE_PAGE, null, 'orcidapi', 'about', null);
		$templateMgr->assign(array(
			'globallyConfigured' => "test",
			'orcidAboutUrl' => "test",
		));
		return parent::fetch($request, $template, $display);
	}


}

