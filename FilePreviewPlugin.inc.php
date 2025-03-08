<?php

/**
 * @file plugins/generic/filePreview/FilePreviewPlugin.inc.php
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Copyright (c) 2023 Universidad Nacional de Lanus
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FilePreviewPlugin
 * @ingroup plugins_generic_filepreview
 *
 * @brief File preview plugin
 *
 */

import('lib.pkp.classes.plugins.GenericPlugin');

/**
 * Class FilePreviewPlugin
 */
class FilePreviewPlugin extends GenericPlugin {
	/**
	 * @copydoc Plugin::getDisplayName()
	 */
	function getDisplayName() {

		return __('plugins.generic.filePreview.displayName');
	}

	/**
	 * @copydoc Plugin::getDescription()
	 */
	function getDescription() {

		return __('plugins.generic.filePreview.description');
	}

	/**
	 * @copydoc Plugin::register()
	 */
	function register($category, $path, $mainContextId = null) {

		if (parent::register($category, $path, $mainContextId)) {
			if ($this->getEnabled()) {

				// Register callbacks.
				HookRegistry::register('TemplateManager::fetch', array($this, 'templateFetchCallback'));
				// Add a handler to process file preview
				HookRegistry::register('LoadComponentHandler', array($this, 'callbackLoadHandler'));

				$this->_registerTemplateResource();
			}
			return true;
		}
		return false;
	}


	/**
	 * Adds additional links to submission files grid row
	 * @param $hookName string The name of the invoked hook
	 * @param $params array Hook parameters
	 */
	public function templateFetchCallback($hookName, $params) {

		$request = $this->getRequest();
		$router = $request->getRouter();
		$dispatcher = $router->getDispatcher();

		$templateMgr = $params[0];
		$resourceName = $params[1];
		if ($resourceName == 'controllers/grid/gridRow.tpl') {
			$row = $templateMgr->getTemplateVars('row');
			$data = $row->getData();
			if (is_array($data) && (isset($data['submissionFile']))) {
				$submissionFile = $data['submissionFile'];
				$fileExtension = strtolower($submissionFile->getData('mimetype'));

				// get stage ID
				$stageId = (int)$request->getUserVar('stageId');

				//if($stageId == 1){

					if (strtolower($fileExtension) == 'application/pdf') {

						import('lib.pkp.classes.linkAction.request.OpenWindowAction');
						$this->_previewAction($row, $dispatcher, $request, $submissionFile, $stageId);

					}

					// elseif (strtolower($fileExtension) == 'application/msword') {
						// TO DO
					// }

				//}

			}
		}
	}

	/**
	 * Add preview with File Preview action to files grid
	 * @param $row SubmissionFilesGridRow
	 * @param Dispatcher $dispatcher
	 * @param PKPRequest $request
	 * @param $submissionFile SubmissionFile
	 * @param int $stageId
	 */
	function _previewAction($row, Dispatcher $dispatcher, PKPRequest $request, $submissionFile, int $stageId){

		// Add grid-level actions
		$router = $request->getRouter();
		import('lib.pkp.classes.linkAction.request.AjaxModal');

		$actionArgs['fileUrl'] = $dispatcher->url($request, ROUTE_COMPONENT, null, 'api.file.FileApiHandler', 'downloadFile', null,
			array(
				'submissionFileId' => $submissionFile->getData('id'),
				'submissionId' => $submissionFile->getData('submissionId'),
				'stageId' => $stageId
			)
		);

		$row->addAction(
			new LinkAction(
				'preview',
				new AjaxModal($router->url($request, null, null, 'preview', null, $actionArgs),
					$this->getDisplayName()),
				__('plugins.generic.filePreview.preview'),
				null
			),
		);
		
	}

	/**
	 * @see PKPComponentRouter::route()
	 */
	public function callbackLoadHandler($hookName, $args) {
		if ($args[1] === "preview") {
			$args[0] = "plugins.generic.filePreview.FilePreviewHandler";
			import($args[0]);
			return true;
		}
		return false;
	}

}
