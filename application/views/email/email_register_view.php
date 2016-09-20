<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * email_register_view
 * 
 * The registration confirmation link email.
 * 
 */

// --------------------------------------------------------------------------
?>
<p>Dear <?php echo ($user['first_name']== '')? '@'.$user['user_name']: $user['first_name']; ?></p>
<p>Welcome to join the community of Linkqlo and thank you for signing up with us!</p>
<p>Linkqlo is a mobile social network to find out what everyone is wearing and discover better fitting clothing brands.</p>
<p>Now, you can start exploring Linkqlo in a few avenues:</p>
<p>1. Enter your body measurements on "Me" page. Take a tape ruler, follow the instructions and start measuring yourself. It's a one-time effort.</p>
<p>2. Browse "Home" page to discover other Linkqlo users whose body is a close match to yours. Follow them if you like their sharing.</p>
<p>3. Share what you wear by posting picture(s), or a Fitting Report on "Post" page. The more information you provide in Fitting Report, the more helpful it will be for other Linkqlo users whose body is similar to yours.</p>
<p>4. Discover what brands are popular among other users with your similar body size on "Discover" page.</p> 
<p>For any questions or issues, please contact support@linkqlo.com.</p>
<p>Visit us here:</p>
<p>
&nbsp;&nbsp;&nbsp;&nbsp;Facebook: https://www.facebook.com/linkqloinc<br/>
&nbsp;&nbsp;&nbsp;&nbsp;Twitter:https://twitter.com/linkqloinc<br/>
&nbsp;&nbsp;&nbsp;&nbsp;Company:http://linkqlo.com/
</p>
<br/>
<br/>
<p>yours sincerely</p>
<br/>
<br/>
<p>Herbert Yang</p>
<p>CEO, Linkqlo Inc</p>
<?php
/* End of file email_register_view.php */
/* Location: ./application/email/email_register_view.php */