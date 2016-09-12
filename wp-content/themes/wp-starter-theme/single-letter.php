<?php get_header(); ?>
<?php $issue_number = get_field( "issue_number" ) ?>
<?php $colors = get_field( "color_scheme" ) ?>

<!-- Default Single Post Template -->

<body id="<?php the_field("color_scheme"); ?>" <?php body_class(); ?>>

<!-- <h1 class="color-1">L</h1> -->

	<div class="wrap">

	<!-- Nav -->
	<nav class="nav color-1" role="navigation">
		<a href="<?php echo home_url(); ?>" class="home-link">VCD Mag</a>
	
		<label class="menu-toggle open"></label>
		<ul class="main-nav">
		<?php

			$args = array(
				'post_type' => array('story','letter','interview'),
				'category__not_in' => 12,
				'meta_query' => array(
					array(
						'value' => "$issue_number",
						),
					),
				);
			$menu_query = new WP_Query( $args ); 

			if ( $menu_query->have_posts() ) : while ( $menu_query->have_posts() ) :
			$menu_query->the_post(); ?> 

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
		</ul>	
	</nav>
	<!-- /Nav -->

	<!-- Main Content -->
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div <?php post_class(); ?>>

		<section id="main-content" class="single-post page-content clearfix">

			<article id="post-wrap"> 

				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<div class="featured-img">
					<?php the_post_thumbnail(full); ?>
				</div>
				<?php endif; ?>

				<div class="type-wrap">
					<!-- post type -->
					<h3 class="post-type color-1">
						<?php $post_type = get_post_type_object( get_post_type($post) );
						echo $post_type->label ; ?>
					</h3>
					<!-- /post type -->

					<!-- post title -->
					<h5 class="subtitle color-3"><?php the_field("subtitle") ?></h5>
					<!-- /post title -->

					<!-- /post content -->
					<div class="post-body color-3"><?php the_content(); ?></div>
					<!-- /post content -->
				</div>

				<?php if ( get_field("end_quote") ) : ?>
					<!-- end quote -->
					<blockquote class="ender color-3">					
						<p class="border-color-1"><?php the_field("end_quote"); ?></p>
					</blockquote>
				<?php endif; ?>
			</article>
		
		<div class="next-post">
			<p class="color-1"><a href="<?php the_field("next_article_link"); ?>">Next Article</a></p>
		</div>
		</section>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>
		
	</div>

	<!-- /wrapper -->

<?php get_footer(); ?>

</div>



