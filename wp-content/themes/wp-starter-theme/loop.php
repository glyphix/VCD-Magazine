<?php if (have_posts()): while (have_posts()) : the_post();?>

	<!-- article -->	
	<article id="post-wrap" <?php post_class(); ?>>

		
		<?php if ( has_post_thumbnail()) : ?>
		<!-- post thumbnail -->
		<a class="featured-img" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(full); ?>
		</a>
		<!-- /post thumbnail -->
		<?php endif; ?>		

		<div class="type-wrap">
			
			<a href="<?php the_permalink(); ?>">
				<!-- post title -->
				<h2 class="title">
					<span class="post-title"><?php the_title(); ?></span>
				</h2>
				<!-- /post title -->
				<h1><?php the_field('issue_number'); ?></h1>
				<!-- post type -->
				<h3 class="post-type"><?php $post_type = get_post_type_object( get_post_type($post) );
					echo $post_type->label ; ?></h3>
				<!-- /post type -->
			</a>
			
			<!-- content -->
			<div class="post-body">
				<?php the_content(); ?>
			</div>
			<!-- /content -->
		</div>

	</article>	
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.'); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
