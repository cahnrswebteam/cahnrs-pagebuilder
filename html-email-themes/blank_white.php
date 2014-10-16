<?php
global $email_styles; 
$email_styles = array(
	'layout-width' => 650,
	'content-row' => array('bgcolor' => '#ffffff', 'css' => '' ),
);?>
<table bgcolor="#cccccc" border="1" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		  <?php 
          if ( have_posts() ) {
              while ( have_posts() ) {
                  the_post();
                  the_content();
              } // end while
          } // end if
          ?>
		</td>
	</tr>
</table>








<script>
var css_styles = new Array();
css_styles[0] = new Array();
css_styles[0][0] = '#email-content a';
css_styles[0][1] = {'text-decoration':'none', 'color':'#981e32'};
css_styles[1] = new Array();
css_styles[1][0] = '#email-content td';
css_styles[1][1] = {'font-family':' Arial, Helvetica, sans-serif','font-size': '12px'};
css_styles[2] = new Array();
css_styles[2][0] = 'h1,h2,h3,h4';
css_styles[2][1] = {'font-family':' Arial, Helvetica, sans-serif','margin': '0','padding-bottom':'6px'};
css_styles[3] = new Array();
css_styles[3][0] = 'h1';
css_styles[3][1] = {'color':'#981e32'};
</script>