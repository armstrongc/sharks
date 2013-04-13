/* Author:

*/


$(document).ready(function(){
	
	$("#dialog").dialog({
		autoOpen: false,
		modal: true	
	});
	
	$("a.confirm-delete").click(function(e){
		
		e.preventDefault();
    	var targetUrl = $(this).attr("href");
		var targetType = $(this).attr("data-type");
		
		$("#dialog").dialog({
		buttons : {
		  "Confirm" : function() {
			window.location.href = targetUrl;
		  },
		  "Cancel" : function() {
			$(this).dialog("close");
		  }
		},
		title: "Delete " + targetType
	  });
		
	  $("#dialog").html("Are you sure you want to delete this " + targetType + "?");
	  $("#dialog").dialog("open");
			
	});
	
	$("a.confirm-live").click(function(e){
		
		e.preventDefault();
    	var targetUrl = $(this).attr("href");
		var targetType = $(this).attr("data-type");
		
		$("#dialog").dialog({
		buttons : {
		  "Confirm" : function() {
			window.location.href = targetUrl;
		  },
		  "Cancel" : function() {
			$(this).dialog("close");
		  }
		},
		title: "Delete " + targetType
	  });
		
	  $("#dialog").html("Are you sure you want to change the live status of this " + targetType + "?");
	  $("#dialog").dialog("open");
			
	});
		
});







