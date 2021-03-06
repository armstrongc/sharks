tinyMCE.init({
	language : "en", 
	mode : "textareas",
	theme : "advanced",
	width:"750",
	height:"350",
	plugins: "inupload",   
  force_br_newlines : true,
  force_p_newlines : false,
  forced_root_block : '',
  theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,|,forecolor,backcolor,|,hr,removeformat,code",
  theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,inupload",
  theme_advanced_buttons3 : "",
  theme_advanced_buttons4 : "",
  theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
  inupload_path: '/var/www/vhosts/host.com/httpdocs/ufiles/',                 
  inupload_sub_path:'http://www.host.com/ufiles/',
  inupload_min_width:'150',
  inupload_max_width:'650',
  document_base_url : 'http://www.host.com',
  relative_urls: false,
  remove_script_host : false
	});
