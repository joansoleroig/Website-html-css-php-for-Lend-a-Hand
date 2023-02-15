<?php
if(!isset($_POST['envia']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; has d'enviar el formulari!";
}

$visitor_email = $_POST['email'];

//Validate first
if(empty($visitor_email))
{
    echo "Has d'escriure el mail";
    exit;
}

//$email_from = 'westudyandteach@gmail.com';//<== update the email address
$email_subject = "Nou subscriptor de la web.";
$email_body = "Contacte: $visitor_email";

$to = "westudyandteach@gmail.com";//<== update the email address
//$headers = "From: $email_from \r\n";
//$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
// mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html'); --------><-------
mail($to, $email_subject, $email_body);
header('Location: index.html');

$servername = "PMYSQL135.dns-servicio.com:3306";
$username = "lendahand";
$password = "Coronavirus1";
$dbname = "7794914_lendahand";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Subscriptors (mail) VALUES ('$visitor_email')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
