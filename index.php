<?php
    // start the session
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: ./Reservation/main.php");
        exit;
    }

    

    // //restart a session with variables set as admin
    //     session_start();
    //     $_SESSION['admin'] = true;
    //     $_SESSION['id'] = $id;
?>

<!DOCTYPE html>

<html>

	<head>
		<title>COMP307 - Main Page</title>
        <link rel="stylesheet" href="style.css">
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="java.js"></script>
        <script type="text/javascript" src="SHA256.js"></script>
    </head>
    


<body style="background-color:#F2EEEB">

    <div id="main">
        <img id="logo" style="width:448.5px; height:256px"  src="sign.png" alt="logo"/>
    </div>

    <div id="description"> The anticaf&eacute concept is to provide a space when you need to study. 
            You will be able to reserve your spot and study in peace as long as you have paid for your seat.
            We will be there if you need anything, either it be food or some drinks to give you the energy to keep going.
            Become one of our members right now and you will never have to worry again if you are going to be able to get a seat at the library!
        
        <a onClick="showLogIn()"><div id="oldMembers">Login</div></a>
        <a onClick="showSignUp()"><div id="newMembers">Sign Up</div></a>
        
    </div>

    <a onClick="showLogIn()"><div class="overlay"></div></a>
    <a class="toQuit" onClick="showLogIn()">X</a>
    <img id="anticafe" src="anti.png" alt="logo"/>
    <div class="popupLogIn"> 
        <!----form class="popup" name="login" action="login.php"  method="post"-->
        <form class="popup" name="login">
        <label for="field1"><span>Enter Your Username</span><input id="login_username" type="text" name="username" required="true" /></label>
        <label for="field2"><span>Enter Your Password</span><input id="login_password" type="password" name="password" required="true" /></label>
        <label><span> </span><span> <input id="login_submit" type="submit" value="Login" />
        </form>
    </div>

    <a onClick="showSignUp()"><div class="overlay2"></div></a>
    <a class="toQuit2" onClick="showSignUp()">X</a>
    <img id="anticafe2" src="anti.png" alt="logo"/>
    <div class="popupSignUp"> 
        <!--form class="popup" name="signup" action="signup.php" onsubmit="return validateForm()" method="post"-->
        <form class="popup" name="signup" onsubmit="return validateForm()">
        <label for="field3"><span>Enter Your First Name</span><input id="fname" type="text" name="fname" required="true" /></label>
        <label for="field4"><span>Enter Your Last Name</span><input id="lname" type="text" name="lname" required="true" /></label>
        <label for="field5"><span>Enter Your E-Mail</span><input id="email" type="email" name="email" required="true" /></label>
        <label for="field6"><span>Verify Your-Email</span><input type="email" name="email2" required="true" /></label>
        <label for="field7"><span>Enter Your Username</span><input id="username" type="text" name="username" required="true" /></label>
        <label for="field8"><span>Enter Your Password</span><input id="password" type="password" name="password" required="true" /></label>
        <label for="field9"><span>Verify Your Password</span><input type="password" name="password2" required="true" /></label>
        <label><span> </span><span> <input id="signup_submit" type="submit" value="Sign Up" />
        </form>
    </div>

    <div id="location">1001 Sherbrooke St W, Montreal, QC H3A 1G5 514.998.4370</div>
</body>


</html>

<script>
$(document).ready(function() {
    $("#signup_submit").click(function(event){
		$.ajax({
		    url: "signup.php", 
            type: "POST",
            data: {'fname': $('#fname').val(),
                   'lname': $('#lname').val(),
                   'username': $('#username').val(),
                   'password': SHA256($('#password').val()),
                   'email': $('#email').val(),
            },                   
			dataType: "json",
            success: function(data){
                if(data.status == 'error'){
                    alert(data.message);
                }else{
                    alert(data.message);
                }
            }
		});
    });
    $("#login_submit").click(function(event){
		$.ajax({
		    url: "login.php", 
            type: "POST",
            data: {'username': $('#login_username').val(),
                   'password': SHA256($('#login_password').val()),
            }, 
			dataType: "json",
            success: function(data){
                if(data.status == 'error'){
                    alert(data.message);
                }else if(data.message == 'admin'){
                    alert('success');
                    document.location.href = '/AdminPage/admin.html';
                }else{
                    alert('user login');
                    
                    // $.ajax({
                    //     url: "../main.php",
                    //     type: "POST",
                    //     data: {'username': $('#login_username').val()}, 
                    //     success: function(response) {
                    //         //this is your response data from serv
                    //         $("html").html(response);
                    //     }
                    // });
                    window.location.href = "../Reservation/main.php";
                    // $.post( "../main.php", { username: $('#login_username').val() }, function(response){
                    //     alert(response);
                    //     $("html").html(response);
                    // } );
                    //<?php
                    //restart a session with varaibles set as user
                    // session_start();
                    // $_SESSION['loggedin'] = true;
                    // $_SESSION['id'] = $id;
                    // $_SESSION['username'] = $username;
                    // header("location: ../Reservation/main.php");
                    ?>
                }
            }
		});
	});

});
</script>