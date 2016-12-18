<?php get_header(); ?>

<?php if(!is_front_page()) { ?>

	<div id="subhead_container">
		
		<div class="row">

		<div class="twelve columns">
			
<h1><?php if ( is_category() ) {
		single_cat_title();
		} elseif (is_tag() ) {
		echo (__( 'Archives for ', 'discover' )); single_tag_title();
		} elseif (is_author() ) {
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));		
		echo (__( 'Archives for ', 'discover' )); echo $curauth->nickname;		
	} elseif (is_archive() ) {
		echo (__( 'Archives for ', 'discover' )); single_month_title(' ', true);
	} else {
		wp_title('',true);
	} ?></h1>
			
			</div>	
			
	</div></div>
	
<?php } ?>


<!-- slider -->
<?php if(is_front_page()) { ?>

<div id="slider_container">

	<div class="row">
		<div class="four columns">
			<h1>Pull the Wire - oficjalna strona</h1>
			<p>Witamy na stronie żyrardowskiego zespołu Pull The Wire. Chcesz się dowiedzieć o nas więcej? Zapraszamy do pozostałych działów oraz na portale społecznościowe</p>
		
		</div>	

		<div class="eight columns">
			<?php get_template_part( 'element-slider', 'home' ); ?>
		</div>
		
	</div>
</div>

<?php } ?> <!-- slider end -->


<!-- home boxes -->
<?php if(is_front_page()) { ?>
	
	<div class="row" id="box_container">

		<?php get_template_part( 'element-boxes', 'home' ); ?>

	</div>
	
<!-- home boxes end -->

<div class="clear"></div>
<?php } ?> 
<!--content-->

		<div class="row" id="content_container">
				
	<!--left col--><div class="eight columns">
	
		<div id="left-col">
			
			<?php get_template_part( 'loop', 'home' ); ?>

	</div> <!--left-col end-->
</div> <!--column end-->

<?php get_sidebar(); ?>

</div>
<!--content end-->
		

<?php get_footer(); ?>