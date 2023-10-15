{**
 * templates/settingsForm.tpl
 *
 * Copyright (c) 2015-2019 University of Pittsburgh
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * ORCID Profile plugin settings
 *
 *}

 <script type="text/javascript">
 $(function() {ldelim}
	 // Attach the form handler.
	 $('#filePreviewPdfForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
 {rdelim});
</script>

<div id="filePreviewPdf">
	<iframe src="http://www.repositoriojmr.unla.edu.ar/descarga/TFI/EsEpi/029492_Perner.pdf" id="iframePDF" frameborder="0" scrolling="no" width="100%" height="700px"></iframe>
	<!--iframe src="http://localhost/ojs/index.php/saludcolectiva/$$$call$$$/api/file/file-api/download-file?submissionFileId=15811&submissionId=4365&stageId=1" id="iframePDF" frameborder="0" scrolling="no" width="100%" height="700px"></iframe-->
</div>

