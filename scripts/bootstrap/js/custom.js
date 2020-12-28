$(function() {
  $("#form").validate({
	  rules: {
		  YourName: "required",
		  YourComment: "required",
		  YourEmail: {
			  required: true,
			  email: true
		  },
	  },
	  messages: {
		  YourName: "Please enter your name",
		  YourComment: "Please enter message",
		  YourEmail: "Please enter a valid email address",
	  },
	  
	  submitHandler: function(form) {
		  form.submit();
	  }
  });
});