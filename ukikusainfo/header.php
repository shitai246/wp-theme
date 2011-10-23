<?php $options = get_option('ukikusa_options'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ukikusa_info' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="header">
	<div id="headerimg">
		<div class="title">
			<?php if ($options['use_logo']): ?>
				a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/img/<?php echo $options['logo_name']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
			<?php else: ?>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		<div class="description"><?php bloginfo( 'description' ); ?></div>
	</div>
        <div id="headermenu">
                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                        <input type="text" placeholder="検索キーワード" value="" name="s" class="text" id="s">
                        <input type="submit" class="submit" id="searchsubmit" value="検索">

		<?php if (!empty($options['twitter'])): ?>
	                <a href="http://twitter.com/#!/<?php echo $options['twitter']; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" width="32" height="32" /></a>
		<?php endif; ?>
		<?php if (!empty($options['mixi'])): ?>
	                <a href="http://mixi.jp/show_friend.pl?id=<?php echo $options['mixi']; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/mixi.png" width="32" height="32" /></a>
		<?php endif; ?>
		<?php if (!empty($options['facebook'])): ?>
	                <a href="http://www.facebook.com/profile.php?id=<?php echo $options['facebook']; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" width="32" height="32" /></a>
		<?php endif; ?>
		<?php if (!empty($options['github'])): ?>
	                <a href="https://github.com/<?php echo $options['github']; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/github.png" width="32" height="32" /></a>
		<?php endif; ?>
                <a href="<?php echo home_url( '/' ); ?>feed"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" width="32" height="32" /></a>
                </form>
        </div>

	<?php wp_nav_menu( array( 'menu' => 'navi', 'sort_column' => 'menu_order', 'container_class' => 'header_menu' ) ); ?>
</div>
<!--/header -->
