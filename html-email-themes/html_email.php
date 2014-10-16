<?php
class cahnrs_html_handler {
	private $send_to;
	private $email_code;
	
	public function __construct(){
		if( isset( $_POST['send_to'] ) && isset( $_POST['email_code'] ) ){
			add_filter( 'wp_mail_content_type', array( $this , 'set_html_content_type' ) );
			$this->send_to = sanitize_text_field( $_POST['send_to'] );
			$this->email_code = $_POST['email_code'];
			if ( get_magic_quotes_gpc() ) $this->email_code = stripslashes( $this->email_code );
			$this->compose_email();
			$this->send_email();
		}
	}
	private function send_email(){
		$subject = get_the_title();
		$headers = 'From: CAHNRS Webteam <cahnrs.webteam@wsu.edu>' . "\r\n";
		wp_mail( $this->send_to, $subject, $this->email_code, $headers );
		remove_filter( 'wp_mail_content_type', array( $this , 'set_html_content_type' ) );
	}
	
	private function compose_email(){
		$email = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>';
		$email .= '<head><title>'.get_the_title().'</title><meta name="viewport" content="width=device-width, initial-scale=1.0"/></head>';
		$email .='<body style="margin: 0; padding: 0;">';
		$email .= $this->email_code;
		$email .= '</body>';
		$email .= '</html>';
		$this->email_code = $email;
	}
	
	public function set_html_content_type(){
		return 'text/html';
	}
}
$html_email = new cahnrs_html_handler();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
var he;
jQuery(document).ready(function(){ he = new init_he(); });
var init_he = function(){
	this.code = jQuery('#email-content');
	this.code_input = jQuery('#send-info textarea');
	he = this;
	
	jQuery('body').on('click','#send-actions a', function(event){
		event.preventDefault();
		jQuery( 'form:first' ).trigger( 'submit' );
		});
	
	jQuery('#sent-email').delay(2000).slideUp('medium');
	
	he.init_code_clean = function(){
		he.apply_css();
		he.code_input.val( he.code.html() );
	}
	
	he.apply_css = function(){
		if( typeof css_styles !== 'undefined' ){
			for( i = 0; i < css_styles.length; i++ ){
				jQuery( css_styles[i][0] ).css( css_styles[i][1] );
			}
		}
	}
	
	he.init_code_clean();
}
</script>
<style>
body {
	font-size: 12px;
	margin: 0;
	padding: 0;
}

#html-email-header {
	background-color: #222;
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	font-family: Arial, Helvetica, sans-serif;
}
#send-info {
	float: left;
	margin: 0 5%;
	height: 50px;
}
#send-info input{
	height: 30px;
	margin-top: 10px;
	vertical-align: top;
	width: 250px;
	padding: 0 15px;
	font-size: 1.2rem;
	color: #555;
	border-radius: 3px;
}
#send-info label {
	display: inline-block;
	line-height: 60px;
	height: 60px;
	font-size: 1.2rem;
	color: #ccc;
}
#send-info textarea{
	display: none;
}
#send-actions {
	float: right;
	margin: 0 5%;
	height: 60px;
	border-right: 1px solid #444;
	border-left: 1px solid #000;
}
#send-actions a {
	text-decoration: none;
	display: inline-block;
	height: 60px;
	line-height: 60px;
	padding: 0 30px;
	color: #ccc;
	font-size: 1.5rem;
	text-transform: uppercase;
	border-left: 1px solid #444;
	border-right: 1px solid #000;
}
#send-actions a:hover {
	background: #555;
}
#sent-email {
	position: absolute;
	top: 100%;
	width: 100%;
	background: #777;
}
#sent-email h3 {
	color: #ddd;
	padding: 6px 5%;
	font-size: 1.1rem;
	margin: 0;
}
#email-content {
	padding-top: 60px;
}
</style>
</head>

<body>
<header id="html-email-header">
	<form id="html_email" method="post">
    	<div id="send-info">
    		<label for="send_to"> Send To: </label>
        	<textarea id="email_code" name="email_code"></textarea>
    		<input id="send_to" type="text" name="send_to" value="" />
    	</div>
        <div id="send-actions">
        <a href="#" >Send Draft</a><a href="#" >Send Final</a>
        </div>
    </form>
    <?php if( isset( $_POST['send_to'] )):?>
    <div id="sent-email">
    <h3>Your email has been sent!</h3>
    </div>
    <?php endif;?>
</header>
<div id="email-content">
<?php include cahnrswp\pagebuilder\DIR.'html-email-themes/blank_white.php';?>
</div>
</body>
</html>