<!-- 
Form for adding an RSVP response to a wedding invitation.
The form contains various fields, which are validated to be sure that they are filled in correctly before the form is submitted as a plain text email
-->


<?php 

  $frmMode = "" ; 
  $names = "" ;
  $contact = "" ; 
  $ceremonyBreakfast = "" ; 
  $reception = "" ; 
  $dietary = "" ; 

  $displayThankyou = false ; 

  $namesError = false;
  $namesErrorMessage = '<span class="error">Please let us know your name(s)</span>' ; 
  $contactError = false ; 
  $contactErrorMessage = '<span class="error">Please let us know your contact telephone number</span>' ;
  $ceremonyBreakfastError = false ;
  $ceremonyBreakfastErrorMessage = '<span class="error">Please let us know if you are attending the Wedding Ceremony and Wedding Breakfast</span>' ; 
  $receptionError = false ;
  $receptionErrorMessage = '<span class="error">Please let us know if you are attending the Evening Reception</span>' ;

  $isError = false ;     

  if (!empty($_POST["frmMode"])) {
    $frmMode = $_POST["frmMode"] ;
  } 

  if($frmMode == "submit") {

    if (!empty($_POST["names"])) {
      $names = $_POST["names"] ;
    } else {
      $namesError = true ;
      $isError = true ;
    }
    
    if (!empty($_POST["contact"])) {
      $contact = $_POST["contact"] ;
    } else {
      $contactError = true ;
      $isError = true ;
    }

    if (!empty($_POST["ceremonyBreakfast"])) {
      $ceremonyBreakfast = $_POST["ceremonyBreakfast"] ;
    } else {
      $ceremonyBreakfastError = true ;
      $isError = true ;
    }

    if (!empty($_POST["reception"])) {
      $reception = $_POST["reception"] ;
    } else {
      $receptionError = true ;
      $isError = true ;
    }

    if (!empty($_POST["dietary"])) {
      $dietary = $_POST["dietary"] ;
    } 

    if (!$isError && $frmMode == "submit") {

      $displayThankyou = true ;

      // Email the form here


      $recipients = ('smithrichard67@sky.com') ; 

      $subjectLine = "Wedding RSVP form response" ;


      $message = "Response from the wedding RSVP form\n" ;
      $message .= "-----------------------------------\n\n" ;

      $message .= "Name(s):\n  " . $names . "\n\n" ; 
      $message .= "Contact number:\n  " . $contact . "\n\n" ; 

      $message .= "Attending the Wedding Ceremony and Wedding Breakfast:\n  " . $ceremonyBreakfast . "\n\n" ;
      $message .= "Attending the Evening Reception:\n  " . $reception . "\n\n" ;

      if(empty($dietary)) {         
        $message .= "Dietary requirements:\n[left blank]" ;   
      } else {
        $message .= "Dietary requirements:\n" . $dietary ; 
      }

    
      mail($recipients, $subjectLine, $message) ; 

    }
  } 
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">


<head>

<title>Page title</title>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css" media="all">@import "sys/style.css";</style>

</head>



<body id="rsvp">


<div id="header">
  <h1><img src="images/backgrounds/rsvp_title.jpg" width="450" height="176" alt="Suzan &amp; John - 12th May 2012"></h1>
</div>

<div id="navbar"><ul><li class="first"><a href="index.htm">Home</a></li><li><a href="rsvp.php">RSVP</a></li><li><a href="day.htm">The Day</a></li><li><a href="directions.htm">Directions</a></li><li><a href="accommodation.htm">Accommodation</a></li><li><a href="gift.htm">Gifts</a></li></ul></div>



<div id="mainContent">


  <h1>RSVP</h1>


  <?php if($displayThankyou) { ?>
    
    <p><strong>Thank you for RSVPing</strong></p>
    <p><a href="index.htm">Return to home page</a></p>

  <?php } else { ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

      <input type="hidden" name="frmMode" value="submit">
  
      <dl>
        <dt><label for="names">Your name(s)<?php if($namesError) { echo $namesErrorMessage ; }?></label></dt>
        <dd><input id="names" name="names" type="text" size="50" value="<?php echo $names ?>"></dd>

        <dt><label for="contact">Contact telephone number<?php if($contactError) { echo $contactErrorMessage ; }?></label></dt>
        <dd><input id="contact" name="contact" type="text" size="30" value="<?php echo $contact ?>"></dd>    
      </dl>

      <fieldset>
        <legend>Wedding Ceremony and Wedding Breakfast</legend>
        <?php if($ceremonyBreakfastError) { echo $ceremonyBreakfastErrorMessage ; }?>
        <input type="radio" name="ceremonyBreakfast" id="ceremony_y" value="yes" <?php if($ceremonyBreakfast=="yes") { echo "checked='checked'"; } ?>><label for="ceremony_y">We will be able to attend</label><br>
        <input type="radio" name="ceremonyBreakfast" id="ceremony_n" value="no" <?php if($ceremonyBreakfast=="no") { echo "checked='checked'"; } ?>><label for="ceremony_n">We will NOT be able to attend</label>
      </fieldset>

      <fieldset>
        <legend>Evening Reception</legend>
        <?php if($receptionError) { echo $receptionErrorMessage ; }?>
        <input type="radio" name="reception" id="reception_y" value="yes" <?php if($reception=="yes") { echo "checked='checked'"; } ?>><label for="reception_y">We will be able to attend</label><br>
        <input type="radio" name="reception" id="reception_n" value="no" <?php if($reception=="no") { echo "checked='checked'"; } ?>><label for="reception_n">We will NOT be able to attend</label>
      </fieldset>

      <dl>
        <dt><label for="dietary">Please advise us of any special dietary requirements</label></dt>
        <dd><textarea id="dietary" name="dietary" rows="2" cols="40"><?php echo $dietary ?></textarea></dd>
      </dl>

      <input type="submit" id="submit" value="Submit">  

    </form>

  <?php } ?>


</div>



</body>

</html>