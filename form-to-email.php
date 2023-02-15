<?php
if(!isset($_POST['envia']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; has d'enviar el formulari!";
}
$fname = $_POST['nom'];
$lname = $_POST['cognom'];
$curs = $_POST['curs'];
$centre = $_POST['centre'];
$visitor_email = $_POST['email'];
$assumpte = $_POST['assumpte'];

//Validate first
if(empty($fname)||empty($lname)||empty($curs)||empty($centre)||empty($visitor_email)) 
{
    echo "Has d'omplir la informacio personal";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "L'adreça email no es valida!";
    exit;
}

$email_from = 'westudyandteach@gmail.com';//<== update the email address
$email_subject = "Nou formulari";
$email_body = "Tens un nou missatge de la web.\nMissatge de : $fname $lname, curs: $curs, centre: $centre.\n Missatge: $assumpte.";
    
$to = "westudyandteach@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html'); --------><-------


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