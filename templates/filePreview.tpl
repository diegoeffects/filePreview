{**
 * templates/filePreview.tpl
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Copyright (c) 2023 Universidad Nacional de Lanus
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * File Preview Plugin modal page
 *
 *}

 <script type="text/javascript">
 $(function() {ldelim}
	 // Attach the form handler.
	 $('#filePreviewPdfForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
 {rdelim});
</script>

<script type="text/javascript">
// Creating iframe's src in JS instead of Smarty so that EZProxy-using sites can find our domain in $pdfUrl and do their rewrites on it.
$(document).ready(function() {ldelim}
	var urlBase = "{$pluginUrl}/pdf.js/web/viewer.html?file=";
	var pdfUrl = {$fileUrl|json_encode};
	{$pdfUrl}
	$("#pdfCanvasContainer > iframe").attr("src", urlBase + encodeURIComponent(pdfUrl));
{rdelim});
</script>

<div id="pdfCanvasContainer" class="galley_view">
	<iframe src="" width="100%" height="100%" style="min-height: 600px;" title="{$galleyTitle}" allowfullscreen webkitallowfullscreen></iframe>
</div>
