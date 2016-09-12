<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article id="post-wrap">
					<h2 class="title"><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>
				</article>

			<?php endwhile; else : ?>
				<p><?php _e( 'Oops!' ); ?></p>
			<?php endif; ?>	

		</section>
		<!-- /section -->
	</main>
