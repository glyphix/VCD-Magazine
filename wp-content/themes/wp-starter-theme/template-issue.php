<?php /* Template Name: Issue */ get_header(); ?>

<?php $issue_number = get_field( "issue_number" ) ?>
<?php $colors = get_field( "color_scheme" ) ?>
<?php $checkit = get_field( "read_more_link" ) ?>

<body id="<?php the_field("color_scheme"); ?>" <?php body_class(); ?>>

	<div class="wrap">

	<!-- Nav -->
	<nav class="nav color-1" role="navigation">
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

	<!-- Header -->
	<header class="header clear" role="banner">
		<h1 id="home-issue_number" class="color-2"><?php the_title(); ?></h1>
		<h1 class="home-title color-1">
			<a href="<?php echo home_url(); ?>"><b>VCD</b><br>Magazine</a>
			<span class="issue-number-caption"><br>Issue #</span>
		</h1>
	</header>

	<!-- Main Content -->
	<div class="page-content clearfix">

		<!-- Featured Article -->
		<section id="featured-content">
			<?php
			$args = array(
				'post_type' => array('story','letter','interview'),
				'category_name' => 'featured',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'value' => "$issue_number",
						),
					),
				);
			$featured_post = new WP_Query( $args );  

				if ( $featured_post->have_posts() ) : while ( $featured_post->have_posts() ) : // Display latest featured article
				$featured_post->the_post(); ?> 

			<article id="post-wrap" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail()) : ?>
					<a class="featured-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
				<?php endif; ?>

				<div class="type-wrap">
					<a href="<?php the_permalink(); ?>">
						<!-- Title -->
						<h2 class="title">
							<span class="post-title background-color-1"><?php the_title(); ?></span>
						</h2>
						<!-- /Title -->
					</a>

					<div class="post-body color-3">
						<p><?php the_field("lead_in"); ?></p>
						<a class="more-link" href="<?php the_permalink(); ?>"><?php the_field("read_more_link") ?></a>
					</div>
				</div>
			</article>

			<?php endwhile; endif; ?> 
			<?php wp_reset_postdata(); ?>

		</section>

		<div class="mini-wrap">
			<section class="front-matter-wrap">

				<!-- Letter from the Director -->
				<section id="letter">
					<?php
					$args = array(
						'post_type' => 'letter',
						'category__not_in' => array( 12, 5 ),
						'meta_query' => array(
							array(
								'value' => "$issue_number",
								),
							),
						);
					$letter = new WP_Query( $args );
					if ( $letter->have_posts() ) : while ( $letter->have_posts() ) : $letter->the_post(); ?>
						<article id="post-wrap" <?php post_class(); ?>>
							<!-- post title -->
							<a href="<?php the_permalink(); ?>">
								<h3 class="post-type color-1">
									<?php $post_type = get_post_type_object( get_post_type($post) );
									echo $post_type->label ; ?>
								</h3>
							</a>
							<!-- post image -->
							<?php if ( has_post_thumbnail()) : ?>
								<a class="featured-img standard" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
							<?php endif; ?>	
							<div class="type-wrap">
								<div class="post-body color-3">
									<p>
										<?php the_field("lead_in"); ?>
									</p>
									<a class="more-link" href="<?php the_permalink(); ?>">
										<?php the_field("read_more_link") ?>		
									</a>
								</div>
							</div>
						</article>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>
				</section>

				<!-- Points of Pride -->
				<?php

				$args = array(
				'post_type' => 'points-of-pride',
				'category__not_in' => array( 12, 5 ),
				'meta_query' => array(
					array(
						'value' => "$issue_number",
						),
					),
				);
				$pop = new WP_Query( $args );
				if ( $pop->have_posts() ) : ?>

					<section id="points">
						<h3 class="post-type color-1">Points of Pride</h3>	
						<div class="swiper-container">
							<ol class="pop-slider swiper-wrapper">
								<?php while ( $pop->have_posts() ) : $pop->the_post(); ?>					
								<li class="swiper-slide border-color-1" id="post-wrap" <?php post_class(); ?>>
									<?php if ( has_post_thumbnail()) : ?>
										<a class="featured-img"><?php the_post_thumbnail(full); ?></a>
									<?php endif; ?>
									<div class="type-wrap">
										<a>
											<h4 class="title color-3"><?php the_title(); ?></h4>
											<h5 class="subtitle color-1"><?php the_field("subtitle") ?></h5>
										</a>
										<div class="post-body color-3"><?php the_content(); ?></div>
									</div>
								</li>			
								<?php endwhile; ?>					
							</ol>
							
							<div class="swiper-pagination"></div>
						</div>
						<div class="swiper-arrow next-button"></div>
		        		<div class="swiper-arrow prev-button"></div>
					</section>
					<script>
						var swiper = new Swiper('.swiper-container', {
						    pagination: '.swiper-pagination',
						    slidesPerView: 'auto',
						    paginationClickable: true,
						    nextButton: '.next-button',
		        			prevButton: '.prev-button',
						});
					</script>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>

				
			</section>


			<!--Interview -->
			<?php
			$args = array(
				'post_type' => array('interview'),
				'category__not_in' => array( 12, 5 ),
				'meta_query' => array(
					array(
						'value' => "$issue_number",
						),
					),
				);
			$story = new WP_Query( $args );
			if ( $story->have_posts() ) : ?>
				<section id="story">
					<?php while ( $story->have_posts() ) : $story->the_post(); ?>
					<article id="post-wrap" <?php post_class(); ?>>
						<a class="featured-img standard" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
						<div class="type-wrap">
							<a href="<?php the_permalink(); ?>">
								<h2 class="title"><span class="post-title background-color-1"><?php the_title(); ?></span></h2>
							</a>
							<div class="post-body color-3">
								<p><?php the_field("lead_in"); ?></p>
								<a class="more-link" href="<?php the_permalink(); ?>"><?php the_field("read_more_link") ?></a>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

			<!-- Glyphix -->
			<?php
			$args = array(
			'post_type' => 'any',
			'category__not_in' => 5,
			'category_name' => 'glyphix',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'value' => "$issue_number",
					),
				),
			);
			$glyph = new WP_Query( $args );
			if ( $glyph->have_posts() ) :?>
				<section id="glyphix">
					<h3 class="post-type color-1">@Glyphix ☞</h3>					
					<ul id="slides" class="slider">
						<?php while ( $glyph->have_posts() ) : $glyph->the_post(); ?>	
						<li class="slide" id="post-wrap" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail()) : ?>
								<div class="full-frame"><?php the_post_thumbnail(full); ?></div>
							<?php endif; ?>
							<div class="post-body contain color-3">
								<?php if ( get_field("include_video") ) : ?>
									<!-- <img class="poster" src="<?php the_field('poster_image');?>"> -->
									<video controls poster="<?php the_field('poster_image');?>">
										<source src="<?php the_field('webm');?>" type=video/webm>
										<source src="<?php the_field('ogg');?>" type=video/ogg>
										<source src="<?php the_field('mp4');?>" type=video/mp4>
										<source src="<?php the_field('3gp');?>" type=video/3gp>
									</video>
									<?php if ( get_field("video_caption") ) : ?>
										<p class="wp-caption-text"><?php the_field("video_caption");?></p>
									<?php endif; ?>
								<?php endif; ?>
								<?php the_content(); ?>
							</div>
						</li>					
						<?php endwhile; ?>					
					</ul>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

			<!-- Interview -->
			<?php
			$args = array(
				'post_type' => array( 'story'),
				'category__not_in' => array( 12, 5 ),
				'meta_query' => array(
					array(
						'value' => "$issue_number",
						),
					),
				);
			$story = new WP_Query( $args );
			if ( $story->have_posts() ) : ?>
				<section id="story">
					<?php while ( $story->have_posts() ) : $story->the_post(); ?>
					<article id="post-wrap" <?php post_class(); ?>>
						<a class="featured-img standard" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
						<div class="type-wrap">
							<a href="<?php the_permalink(); ?>">
								<h2 class="title"><span class="post-title background-color-1"><?php the_title(); ?></span></h2>
							</a>
							<div class="post-body color-3">
								<p><?php the_field("lead_in"); ?></p>
								<a class="more-link" href="<?php the_permalink(); ?>"><?php the_field("read_more_link") ?></a>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>

	

	<?php get_footer(); ?>

