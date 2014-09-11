// Content Contact Form
$(function () {
    $('.error').hide();
   // $('.text-input').css({backgroundColor:"#ececec"});
    $('.text-input').focus(function () {
        $(this).css({border:"2px solid #de675f"});
        $(this).css({background:"#fff"});
    });
    $('.text-input').blur(function () {
        $(this).css({border:"2px solid #fff"});
        $(this).css({background:"transparent"});
    });

    $(".form-button").click(function () {

        // validate and process form
        // first hide any error messages
        $('.error').hide();
        $(this).prop('disabled',true);

        var name = $("input#name").val();
        if (name == "" || name == "Name") {
            $("label#name_error").show();
            $("input#name").focus();
            return false;
        }

		var response = $('input:radio[name=response]:checked').val();
		if($('input:radio[name=response]').is(':checked')) {

		} else {
			$("label#response_error").show();
            $("input#response_accepted").focus();
			return false;
		}

        var email = $("input#email").val();
        var filter = /^[0-9]{11}$/;
        console.log(filter.test(email));
        if (!filter.test(email)) {
            $("label#email_error").show();
            $("input#email").focus();
            return false;
        }

		var guests = $("input#guests").val();
        if (guests == "") {
            $("label#guests_error").show();
            $("input#guests").focus();
            return false;
        }

        var message = $("#input-message").val();
        if (message == "") {
            $("label#message_error").show();
            $("#input-message").focus();
            return false;
        }

        if (name !="" && response !="" && email !="" && guests !="") {
              $(this).prop('disabled',true);
        }

        var dataString = 'name=' + name + '&response=' + response + '&phonenumber=' + email + '&guests=' + guests + '&message=' + message;
        //alert (dataString);return false;

        $.ajax({
            type:"POST",
            url:"save.php",
            data:dataString,
            success:function () {
                $('#af-form').parent().parent().append("<div class=\"alert alert-success fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>谢谢您的祝福，愿天下有情人终成眷属！</strong></div>");
                $('#af-form')[0].reset();
                $('.form-button').prop('disabled',false);
            }
        });
        return false;
    });
});