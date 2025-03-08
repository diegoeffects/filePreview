<?php

/**
 * @file plugins/generic/filePreview/FilePreviewHandler.inc.php
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Copyright (c) 2023 Universidad Nacional de Lanus
 * Distributed under the GNU GPL v2 or later. For full terms see the LICENSE file.
 *
 * @ingroup plugins_generic_filePreview
 * @brief Handles controller requests for File Preview plugin.
 */

import('classes.handler.Handler');

class FilePreviewHandler extends Handler {

	/**
	 * @copydoc GridHandler::initialize()
	 */
	function initialize($request, $args = null) {
		parent::initialize($request, $args);
		// Load grid locale for 'grid.user.cannotAdminister' error.
		AppLocale::requireComponents(
			LOCALE_COMPONENT_PKP_GRID
		);
	}

	/**
	 * Handle preview action
	 * @param $args array Arguments array.
	 * @param $request PKPRequest Request object.
	 */
	function preview($args, $request) {
		$templateMgr = TemplateManager::getManager($request);
        $context = $request->getContext();
		$plugin = PluginRegistry::getPlugin('generic', 'filepreviewplugin');
		
		$contextId = ($context == null) ? 0 : $context->getId();

		$fileUrl = $args['fileUrl'];
		$fileUrl = str_replace("$", "%24", $fileUrl);
		$templateMgr->assign(array(
			'pluginUrl' => $request->getBaseUrl() . '/' . $plugin->getPluginPath(),
			'fileUrl' => $fileUrl,
		));

		import('plugins.generic.filePreview.classes.form.FilePreviewForm');
		$form = new FilePreviewForm($plugin, $contextId, $args);
		$form->initData();
		return new JSONMessage(true, $form->fetch($request));
	}

}