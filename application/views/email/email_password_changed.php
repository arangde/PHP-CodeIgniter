<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------------
?>
<p>Hi <?php echo $user['email_address']; ?>, 
<br/>
<br/>
Your password has been changed at the below time successfully! 
<br/>
<br/>
<?php echo date("F j, Y, g:i a e"); ?>
<br/>
<br/>
Please feel free to reach out to us anytime at <?php echo $this->session->userdata("contact_email"); ?>.
<br/>
<br/>
Thank you!
<br/>
<br/>
Team <?php echo $this->session->userdata("system_title"); ?>
</p>
<?php
