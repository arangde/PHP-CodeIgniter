<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------------
?>
<p>Hi <?php echo $user['email_address']; ?>, 
<br/>
<br/>
Here's a link to reset your password:
<br/>
<br/>
<a href="<?php echo $reset_url; ?>" target="_blank"><?php echo $reset_url; ?></a> 
<br/>
<br/>
If you have any questions, please reach out to us at <?php echo $this->session->userdata("contact_email"); ?>.
<br/>
<br/>
Thank you and see you soon!
<br/>
<br/>
Team <?php echo $this->session->userdata("system_title"); ?>
</p>
<?php
