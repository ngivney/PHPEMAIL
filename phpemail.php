<?php
// start session
session_start();

// if sendemail button is clicked, compose email
if (isset($_POST['sendemail'])) {

$to = "receiveremailaddress@goeshere.com";
$subject = "PHP Email Example";

$message = "
<table>
<tr><td align='center'>
<H3 align='center'><strong>PHP Email Example</strong></H3>
</td></tr>
<tr><td>
This is the body of the email text.
</td></tr>
</table>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <senderemailaddress@goeshere.com>' . "\r\n";

if(mail($to, $subject, $message, $headers)) { 
echo "Mail Successful";
} else { 
echo "Mail Failed";
}  
}
session_destroy();
?>


<table>
<tr><td>
<form name='phpemail' action='<?php echo $_SERVER['PHP_SELF'];?>'  method='post'>
<tr>
<td> 
&nbsp; <input type='submit' value='Send Email' name='sendemail'/>
</td>
</tr>
</form>
</td></tr>
</table>
