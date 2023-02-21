<!DOCTYPE HTML>
<html>
<head <?php language_attributes(); ?>>
    <title><?php wp_title(''); ?></title>
    <meta http-equiv="Content-Type" content="text/html;">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5JSM8B3');</script>
    <?php
        $js_directory_uri = get_template_directory_uri() . '/js/';
    ?>
    <script src="<?php print $js_directory_uri;?>moment.min.js" type="text/javascript"></script>

    <?php 
    wp_head();
    $favicon = get_option( 'theme_favicon' );
    ?>
    <meta name='apple-itunes-app' content='app-id=​myAppStoreID​'>
    <link rel="icon" href="<?php print $favicon;?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php print $favicon;?>" type="image/x-icon" />


</head>
<body  <?php if (is_front_page()) { print ' class="front_page" '; } ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5JSM8B3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="root">
<div class="app">
<div class="app_main">
	<header>
        <div class="container height_100">			<div class="row align-items-center height_100">
				<div class="col-auto mob_menu">
					<button  id="hamburger_header" class="hamburger hamburger--collapse" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
				</div>
			    <div class="col logo">
					<?php if ( !is_front_page()) { print '<a href="'.get_home_url().'">'; } ?>
                    <?php dynamic_sidebar("logo");?>
					<?php if ( !is_front_page()) print '</a>'; ?>
				</div>
				<div class="col-auto menu">
					<?php
					    if ( has_nav_menu( 'header' ) ) {
					    wp_nav_menu( array(
					    'theme_location' 	=> 'header',
					    'menu_class' 	 	=> 'header_menu_links',
					    'container'		 	=> '',
					    'container_class' 	=> '',
						'menu_id'         => 'header_menu_links',
					    'walker' 			=> new Main_Submenu_Class()));
					    }
					    ?>
				</div>
				<div class="col-auto buts">
                    <?php dynamic_sidebar("header_buts");?>
                </div>
			</div>    </div>
	</header>
<main <?php if(is_singular( 'post' )){ ?> class="single_page" <?php } ?>>