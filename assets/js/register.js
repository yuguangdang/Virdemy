$(document).ready(function() {

	//On click signup, hide login and show registration form
	$("#signup").click(function() {
        event.preventDefault();
		$("#first").slideUp("slow", function(){
			$("#second").slideDown("slow");
            console.log("clicked")
		});
        
	});

	//On click signup, hide registration and show login form
	$("#signin").click(function() {
		$("#second").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});
});