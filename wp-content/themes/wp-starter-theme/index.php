<?php get_header(); ?>

<div class="content_bg_white page-content clearfix">

	<!-- Featured Article -->
	<section id="featured-content">
		<?php $featured_post = new WP_Query( "category_name=featured&post_type=any&posts_per_page=1" ); // Display latest featured article
			if ( $featured_post->have_posts() ) : while ( $featured_post->have_posts() ) : 
			$featured_post->the_post(); ?>

		<article id="post-wrap" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail()) : ?>
			<a class="featured-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
			<?php endif; ?>		
			<div class="type-wrap">
				<a href="<?php the_permalink(); ?>">
					<h2 class="title"><span class="post-title"><?php the_title(); ?></span></h2>
					<h3 class="post-type"><?php $post_type = get_post_type_object( get_post_type($post) );
						echo $post_type->label ; ?></h3>
					</a>
				<div class="post-body"><?php the_content(); ?></div>
				<p><?php the_tags(); ?></p>
			</div>
		</article>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>
	</section>
	<!-- /Featured Article -->

	<!-- Letter from the Director -->
	<section id="letter">
		<?php $letter = new WP_Query( "post_type=letter" ); // Display latest featured article
			if ( $letter->have_posts() ) : while ( $letter->have_posts() ) : 
			$letter->the_post(); ?>

		<article id="post-wrap" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail()) : ?>
			<a class="featured-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
			<?php endif; ?>		
			<div class="type-wrap">
				<a href="<?php the_permalink(); ?>">
					<h2 class="title"><span class="post-title"><?php the_title(); ?></span></h2>
					<h3 class="post-type"><?php $post_type = get_post_type_object( get_post_type($post) );
						echo $post_type->label ; ?></h3>
					</a>
				<div class="post-body"><?php the_content(); ?></div>
				<p><?php the_tags(); ?></p>
			</div>
		</article>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>
	</section>
	<!-- /Letter from the Director -->

	<!-- Points of Pride -->
	<section id="points">
		<?php $pop = new WP_Query( "post_type=any" ); // Display latest featured article
			if ( $pop->have_posts() ) : while ( $pop->have_posts() ) : 
			$pop->the_post(); ?>

		<article id="post-wrap" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail()) : ?>
			<a class="featured-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(full); ?></a>
			<?php endif; ?>		
			<div class="type-wrap">
				<a href="<?php the_permalink(); ?>">
					<h2 class="title"><span class="post-title"><?php the_title(); ?></span></h2>
					<h3 class="post-type"><?php $post_type = get_post_type_object( get_post_type($post) );
						echo $post_type->label ; ?></h3>
					</a>
				<div class="post-body"><?php the_content(); ?></div>
				<p><?php the_tags(); ?></p>
			</div>
		</article>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>
	</section>
	<!-- /Points of Pride -->

	<!-- Main Content -->
	<section id="main-content">
		<?php get_template_part('loop'); ?>
		<?php get_template_part('pagination'); ?>
	</section>
	<!-- /Main Content -->

</div>
<?php get_footer(); ?>
