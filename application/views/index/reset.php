<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>

<!-- CSS -->
<?php
	echo css('basic.css');
	echo css('style.css');
	echo css('style-responsive.css');
?>

<!-- Scripts -->
<?php
	echo js('jquery-1.8.3.js');
	echo js('jquery-ui.js');
?>

<!-- Menu Dropdown -->
<script type="text/javascript">
	$(function() {
		$("form[name='reset-form']").submit(function(e) {
			var error = "";
			
			if($("#password").val() == "") {
				error = "<p><?php echo translate("You must enter password"); ?>.</p>";
			}
			else if($("#password").val().length<6) {
				error = "<p><?php echo translate("You must enter password with 6 characters at least"); ?>.</p>";
			}
			else if($("#password").val() != $("#password_confirm").val()) {
				error = "<p><?php echo translate("You must enter confirm password again"); ?>.</p>";
			}
					
			if(error != "") {
				$(".msgbox").html("<div class='alert alert-error'>" + error + "</div>");
				return false;
			}
		});
	});
</script>
</head>

<body>
	<div id="header-sec">
		<div id="header-sec-in">
	    	<h2>Reset your password in <?php echo $title; ?></h2>
	    	
	    	<div class="msgbox">
		    	<?php if(isset($data['error'])) { ?>
		            <div class="alert alert-error">
						<?php echo $data['error']; ?>
					</div>
		        <?php } ?>
		        
		        <?php if(isset($data['success'])) { ?>
		            <div class="alert alert-success">
						<?php echo $data['success']; ?>
					</div>
		        <?php } ?>
			</div>
			
			<?php if(!isset($data['success'])) { ?>
			
	        <div class="centered">
	            <div class="sign-box ">
	                
	                <div id="login-widget" class="pull-left">
		        		<div class="box-style pull-left">
	        		        <form method="post" name="reset-form" action="<?php echo base_url("index/reset/". $data['active_code']); ?>">
	                            <div class="form-top">
			                        <input type="password" id="password" name="password" value="" placeholder="Password"/>
			                        <input type="password" id="password_confirm" name="password_confirm" value="" placeholder="Password Confirm"/>
			                        
			                        <div class="fullwidth pull-left">
			                        	<input type="hidden" name="cmd" value="reset" />
			                            <span class="pull-right"><input type="submit" id="btn-submit" name="Submit" value="Submit" /></span>
			                        </div>
			                    </div>
		                    </form>
		                </div>
	                </div>
	            </div>
	        </div>
	        
	        <?php } ?>
	    </div>
	</div>
</body>
</html>