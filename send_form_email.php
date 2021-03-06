<?php
  if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "braisin@gmail.com";
    $email_subject = "Message from bradraisin.com";


    function died($error) {
      // your error code can go here
      echo "We are very sorry, but there were error(s) found with the form you submitted. ";
      echo "These errors appear below.<br /><br />";
      echo $error."<br /><br />";
      echo "Please go back and fix these errors.<br /><br />";
      die();
    }

    // validation expected data exists
    if(!isset($_POST['first_name']) ||
      !isset($_POST['last_name']) ||
      !isset($_POST['email']) ||
      !isset($_POST['message'])) {
      died('Please fill out all required forms.');
    }

    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email_from)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$first_name)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if(!preg_match($string_exp,$last_name)) {
      $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }

    if(strlen($message) < 2) {
      $error_message .= 'The message you entered does not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
      died($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->
<html>
  <head>
    <LINK REL="stylesheet" HREF="creative.css" TYPE="text/css" />
    <META HTTP-EQUIV="Refresh" CONTENT="8; URL=http://www.bradraisin.com">

    <style>
      body {
        background-color: #000000;
        font: Arial, Helvetica, sans-serif;
        color: #ffffff;
      }
    </style>
  </head>
  <body>
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="58" align="center" valign="top"><img src="img/name.jpg"></td>
      </tr>
      <tr>
        <td height="58" align="center" valign="top" >
          <br />
          <br />
          <h3>
              Thank you for contacting Brad.
              <br/>
              If your message requires a response,
              <br />
              He will get back to you as soon as he can.
              <br />
              Thank you.
          </h3>
          <br />
          <br />
          <img src="img/decorativewhite.png" />
          <br />
          <br />
        </td>
      </tr>
    </table>
  </body>
</html>

<?php
}
?>
