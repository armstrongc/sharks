<script type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_deselector : "no-editor",
		theme : "advanced",
		elements : "ajaxfilemanager",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "image,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,|,bullist,numlist,|,indent,blockquote,|,undo,redo,code",
		theme_advanced_buttons2 : "",
/*		,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor
*/		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_source_editor_wrap : true,
		// This bit will keep formatting of HTML
		apply_source_formatting : false,
		verify_html : false,
		remove_linebreaks: false,

		relative_urls : false,
		file_browser_callback : "ajaxfilemanager",
		// Example content CSS (should be your site CSS)
		content_css : "/css/admin_tinymce.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"

	});

	function ajaxfilemanager(field_name, url, type, win) {
	  var ajaxfilemanagerurl = "/SNS/scripts/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
	  var view = 'detail';
	  switch (type) {
		  case "image":
		  view = 'thumbnail';
			  break;
		  case "media":
			  break;
		  case "flash":
			  break;
		  case "file":
			  break;
		  default:
			  return false;
	  }
	  tinyMCE.activeEditor.windowManager.open({
		  url: "/SNS/scripts/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
		  width: 782,
		  height: 440,
		  inline : "yes",
		  close_previous : "no"
	  },{
		  window : win,
		  input : field_name
	  });

  }

</script>
