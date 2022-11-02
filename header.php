<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
<div class="container">
    <?php
if ( function_exists( 'the_custom_logo' ) ) { 
	the_custom_logo(); 
}
    ?>

<?php 
    wp_nav_menu(
        array(
            'theme_location' => 'header_nav'
        )
        ); 
    get_search_form();    
?>
      
    
