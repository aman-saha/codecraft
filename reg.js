$(document).ready(function(){
	$("#register").click(function(){
		//alert('hello');
	  	var btnval = $(this).html();
		var fname = $("#name").val();
	    var email = $("#email").val();
	    var mobile = $("#mobile").val();
	    var message = $("#message").val();
	    //alert(message);
	    var status = 0;
	    status = validfName(fname);
	    status = validEmail(email);
	    status = validMobileNumber(mobile);
	    if(status)
		{		
			$.ajax({
			  type: 'POST',
			  url: 'signup.php',
			  data: {fname:fname,email:email,mobile:mobile,message:message},
			  success: function(data){
			  	checkStatus(data);
			  }
			});
		}
	});
});

function validfName(name)
{
	if(name == "")
		{$("#fname_err").html("Please enter a name");return 0;}
	else if(!/^[A-Za-z\s]+$/.test(name))
		{$("#fname_err").html("Only letters and whitespaces allowed");return 0;}
	return 1;
}

function validEmail(email) 
{
    var x = email;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
    {
        $("#email_err").html("Please enter a valid email");
        return 0;
    }
    return 1;
}

function validMobileNumber(txtMobile) 
{
	var l = txtMobile.length;
	if(l!=10)
	{
		$("#mobile_err").html("Please enter a 10-digit number");
		return 0;
	}
	else if(txtMobile =="")
	{
		$("#mobile_err").html("Please enter a mobile number");
		return 0;
	}
		return 1;
}
function checkStatus(status)
{
	window.alert(status);
	/*var data = $.trim(status);
	if(data=="Success Signup")
	{
		$("#err_msg").html(data);
	}
	else if(data=="Wrong Signup")
	{
		$("#err_msg").html(data);
	}*/
}