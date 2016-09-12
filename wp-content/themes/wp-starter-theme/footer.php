			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<?php if ( is_active_sidebar( 'widget-area-1' ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<?php dynamic_sidebar( 'widget-area-1' ); ?>
				</div>
				<!-- #primary-sidebar -->
				<?php endif; ?>

			</footer>
			<!-- /footer -->

			<div id="rock-bottom" class="secondary-sidebar footer" role="complementary">

				<?php if ( is_active_sidebar( 'widget-area-2' ) ) : ?>
				
					<?php dynamic_sidebar( 'widget-area-2' ); ?>
				
				<!-- #primary-sidebar -->
				<?php endif; ?>
				<!-- copyright -->
				<div class="ksu-logo"></div>
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.
				</p>
				<!-- /copyright -->
				
				
			</div>

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
