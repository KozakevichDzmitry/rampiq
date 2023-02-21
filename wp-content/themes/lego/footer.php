</main>
</div>
</div></div>

<footer <?php if(is_single()){?> class="footer_post" <?php } ?>>
<div class="container">
	<div class="row">
	    <div class="col-lg col-12 logo_block">
            <div class="logo"><?php dynamic_sidebar("logo");?></div>
	        <?php
		    if ( has_nav_menu( 'footer_3' ) ) {
	            wp_nav_menu( array(
	            'theme_location' 	=> 'footer_3',
	            'menu_class' 	 	=> 'footer_3_footer',
	            'container'		 	=> '',
	            'container_class' 	=> '',
	            'menu_id'         => 'footer_3_footer',
	            'walker' 			=> new Main_Submenu_Class()));
			}
					    ?>
            <div class="copyright"><?php dynamic_sidebar("footer_copyright");?></div>
	    </div>
	    <div class="col-lg-3 col-md menu_1">
            <?php dynamic_sidebar("footer_menu_1");?>
	    </div>
	    <div class="col-lg-3 col-md menu_2">
            <?php dynamic_sidebar("footer_menu_2");?>

	    </div>
	    <div class="col-lg-auto col-md menu_3">
			<script type="text/javascript" src="https://widget.clutch.co/static/js/widget.js"></script> <div class="clutch-widget" data-url="https://widget.clutch.co" data-widget-type="2" data-height="45" data-clutchcompany-id="1766841"></div>
	        <?php
		    if ( has_nav_menu( 'social' ) ) {
	            wp_nav_menu( array(
	            'theme_location' 	=> 'social',
	            'menu_class' 	 	=> 'social_footer',
	            'container'		 	=> '',
	            'container_class' 	=> '',
	            'menu_id'         => 'social_footer',
	            'walker' 			=> new Main_Submenu_Class()));
			}
					    ?>
	    </div>
        <div class="col-12 mob_footer">
            <?php
            if ( has_nav_menu( 'footer_3' ) ) {
                wp_nav_menu( array(
                    'theme_location' 	=> 'footer_3',
                    'menu_class' 	 	=> 'footer_3_footer',
                    'container'		 	=> '',
                    'container_class' 	=> '',
                    'menu_id'         => 'footer_3_footer',
                    'walker' 			=> new Main_Submenu_Class()));
            }
            ?>
            <div class="copyright"><?php dynamic_sidebar("footer_copyright");?></div>
        </div>
	</div>
</div>

</footer>

<div class="mobile_menu ">
<?php
					    if ( has_nav_menu( 'header' ) ) {
					    wp_nav_menu( array(
					    'theme_location' 	=> 'header',
					    'menu_class' 	 	=> 'header_menu_mob',
					    'container'		 	=> '',
					    'container_class' 	=> '',
						'menu_id'         => 'header_menu_mob',
					    'walker' 			=> new Main_Submenu_Class()));
					    }
					    ?>
</div>
<div class="bg "></div> 
<script>
var ajax_web_url = '<?php echo admin_url('admin-ajax.php', 'relative') ?>';   
</script>


<?php wp_footer(); ?>
<script type='text/javascript'>
jQuery(document).ready(function(jQuery){jQuery.datepicker.setDefaults({"closeText":"Close","currentText":"Today","monthNames":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthNamesShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"nextText":"Next","prevText":"Previous","dayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"dayNamesShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"dayNamesMin":["S","M","T","W","T","F","S"],"dateFormat":"MM d, yy","firstDay":1,"isRTL":false});});
</script>

</body>
</html>