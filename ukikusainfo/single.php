<?php $options = get_option('ukikusa_options'); ?>
<?php get_header(); ?>

<div id="contents">
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>

		<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

			<?php /* 日付とか */ ?> 
			<div class="post-info">
				<span class="post-year"><?php the_time('Y') ?></span><br />
				<span class="post-date"><?php the_time('m') ?>/<?php the_time('d') ?></span><br />
			</div><!-- END post-info -->

			<?php /* エントリタイトル */ ?>
			<div class="entry">
				<?php if (!empty($options['adsense'])) { ?>
					<div class="none" style="margin-bottom:15px;">
						<?php echo $options['adsense']; ?>
					</div>
				<?php } ?>
				<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'ukikusa_info'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h2>
				<?php if ( $options['excerpt_check']=='true' ) { the_excerpt(__('Read more &raquo;','ukikusa_info')); } else { the_content(__('Read more &raquo;','ukikusa_info')); } ?>

				<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/hatena-bookmark-anywhere.js" charset="utf-8"></script>
				<script type= "text/javascript">
					var hatena_bookmark_anywhere_url = "<?php the_permalink(); ?>";
				</script>
				<div id="hatena_bookmark_anywhere"></div>
			</div><!-- END entry -->
		</div><!-- END post -->

		<?php endwhile; else: ?>
			<div class="post post-single">
				<h2 class="title title-single"><?php _e('Error 404 - Not Found', 'ukikusa_info'); ?></h2>
				<div class="post-info-top" style="height:1px;"></div>
				<div class="entry">
					<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'ukikusa_info'); ?></p>
					<h3><?php _e('Random Posts', 'ukikusa_info'); ?></h3>
					<ul>
						<?php
							$rand_posts = get_posts('numberposts=5&orderby=rand');
							foreach( $rand_posts as $post ) :
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<h3><?php _e('Tag Cloud', 'ukikusa_info'); ?></h3>
					<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
				</div><!--entry-->
			</div><!--post-->
			<?php endif; ?>
		<?php
		if(function_exists('wp_page_numbers')) {
			wp_page_numbers();
		}
		elseif(function_exists('wp_pagenavi')) {
			wp_pagenavi();
		} else {
			global $wp_query;
			$total_pages = $wp_query->max_num_pages;
			if ( $total_pages > 1 ) {
				echo '<div id="pagination">';
					posts_nav_link(' | ', __('&laquo; Prev','ukikusa_info'), __('Next &raquo;','ukikusa_info'));
				echo '</div>';
			}
		}
		?>
	</div><!-- #content -->
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div><!-- END side -->
</div><!-- #contents -->
<?php get_footer(); ?>
