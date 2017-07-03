<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!-- html -->
 <div class="g-signin2" data-onsuccess="onSignIn"></div>

</body>
</html>
<!-- 
script -->

<script>
   function onSignIn(googleUser) {

        var profile = googleUser.getBasicProfile();
        var id = profile.getId();
        var name = profile.getName();
        var email = profile.getEmail();

        $.ajax({
            'url': '<?php echo base_url() ?>app/insertGoogleUser',
            'type': 'POST',
            'data': {
                'id': id,
                'name': name,
                'email': email

            },
            success: function (data) {
                $(".modal-content .close").click()

                if (data != '') {
                    $("#login").hide();
                    $("#signout").show();
                    $('#subscriber_id').val(data);

                } else {
                    $('#subscriber_id').val();

                    $("#login").show();
                }

            }

        });
    }

</script>

<script>

    function signOut() {

        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {

            $('#subscriber_id').val();
            //$("#signout").hide();
            //$("#login").show();

            location.reload();

        });

    }
</script>

<?php 


// controller code

    public function insertGoogleUser(){


    	$_SESSION['subscriber_id'] = $this->input->post('id');
    	$_SESSION['login_type'] = 'google';

    	 $data = array('user_username' => $this->input->post('name'),
		    	'user_display_name' => $this->input->post('name'),
		    	'user_role' => 'subscriber',
		    	'user_status' => '2',
		    	'login_type' => 'google',
		    	'subscriber_id' => $this->input->post('id'),
		    	'user_email' =>$this->input->post('email')
		    	);

		 $this->User_Model->insert($data);

		 echo $_SESSION['subscriber_id'];


    }

    ?><?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><WM002Response xmlns="ooVooWS" /></soap:Body></soap:Envelope>