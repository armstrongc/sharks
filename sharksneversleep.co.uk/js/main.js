$(document).ready(function(){
	$("#menuToggle").click(function(){
		$(this).toggleClass("open").next("#topNavigation").toggleClass("open");
	});
});