<?php
if( isset($_POST) ){
     
//form validation vars
    $formok = true;
    $errors = array();
     
//sumbission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y');
    $time = date('H:i:s');
     
//form data    
    $email = $_POST['email'];
    $name = $_POST['name'];
    $abbr = $_POST['abbr'];
    $plan = $_POST['plan'];
    $message = $_POST['message'];
     
//validate form data

//validate email address is not empty
    if(empty($email)){
    $formok = false;
    $errors[] = "You have not entered an email address";
//validate email address is valid
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $formok = false;
    $errors[] = "You have not entered a valid email address";
    }

//validate coinname is not empty
    if(empty($name)){
    $formok = false;
    $errors[] = "You have not entered the coin name";
    }
//validate coinabbr is not empty
    if(empty($abbr)){
    $formok = false;
    $errors[] = "You have not entered the coin abbreviation";
    }
//validate message is not empty
    if(empty($message)){
    $formok = false;
    $errors[] = "You have not entered a message";
    }
//validate message is less than 80 charcters
    elseif(strlen($message) > 80){
    $formok = false;
    $errors[] = "Your message must be less than 80 characters";
    }

//send email if all is ok
    if($formok){
    $headers = "From: admin@icoinhost.com" . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
     
    $emailbody = "<p>You have recieved a new message from the icoinhost.com.</p>
		  <p>Check if all these are right:</p>
                  <p><strong>Email Address: </strong> {$email} </p>
		  <p><strong>CoinName: </strong> {$name} </p>
		  <p><strong>CoinAbbr: </strong> {$abbr} </p>
		  <p><strong>Plan: </strong> {$plan} </p>
		  <p><strong>Message: </strong> {$message} </p>
                  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";  
    mail("admin@icoinhost.com","New Coin",$emailbody,$headers); 
	}
//what we need to return back to our form
    $returndata = array(
    'posted_form_data' => array(
    'email' => $email,
    'name' => $name,
    'abbr' => $abbr,
    'plan' => $plan,
    'message' => $message
    ),
    'form_ok' => $formok,
    'errors' => $errors
    );
	
//if this is not an ajax request
    if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
     
//set session variables
    session_start();
    $_SESSION['cf_returndata'] = $returndata;
     
//redirect back to form
    header('location: ' . $_SERVER['HTTP_REFERER']);
	}
}

