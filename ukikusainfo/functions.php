<?php
// ウィジェットエリア
// サイドバーのウィジェット
register_sidebar( array(
     'name' => __( 'Side Widget' ),
     'id' => 'side-widget',
     'before_widget' => '<li class="widget-container">',
     'after_widget' => '</li>',
     'before_title' => '<h3>',
     'after_title' => '</h3>',
) );
 
// カスタムナビゲーションメニュー
add_theme_support('menus');

// オプション設定
$ukikusaDefaultOptions = array(
	'use_logo' => false,
	'logo_name' => 'logo.gif',
	'twitter' => '',
	'facebook' => '',
	'mixi' => '',
	'github' => '',
	'adsense' => ''
);

$optionsSaved = false;
function ukikusa_create_options() {
	// 初期値取得
	$options = $GLOBALS['ukikusaDefaultOptions'];

	$DBOptions = get_option('ukikusa_options');
	if ( !is_array($DBOptions) ) $DBOptions = array();

	foreach ( $options as $key => $value )
		if ( isset($DBOptions[$key]) )
			$options[$key] = $DBOptions[$key];
	update_option('ukikusa_options', $options);
	return $options;
}

function ukikusa_get_options() {
	static $return = false;
	if($return !== false)
		return $return;

	$options = get_option('ukikusa_options');
	if(!empty($options) && count($options) == count($GLOBALS['ukikusaDefaultOptions']))
		$return = $options;
	else $return = $GLOBALS['ukikusaDefaultOptions'];
	return $return;
}

function ukikusa_add_theme_options() {
	global $optionsSaved;
	if(isset($_POST['ukikusa_save_options'])) {

		$options = ukikusa_create_options();

		// logo
		if ($_POST['use_logo']) {
			$options['use_logo'] = (bool)true;
		} else {
			$options['use_logo'] = (bool)false;
		}
		$options['logo_name'] = stripslashes($_POST['logo_name']);

		// ソーシャルサービス
		$options['twitter'] = stripslashes($_POST['twitter']);
		$options['facebook'] = stripslashes($_POST['facebook']);
		$options['mixi'] = stripslashes($_POST['mixi']);
		$options['github'] = stripslashes($_POST['github']);

		// 広告枠
		$options['adsense'] = stripslashes($_POST['adsense']);

		update_option('ukikusa_options', $options);
		$optionsSaved = true;
	}
	add_theme_page(__('オプション設定', 'ukikusa'), __('オプション設定', 'ukikusa'), 'edit_themes', basename(__FILE__),'ukikusa_add_theme_page');
}

function ukikusa_add_theme_page () {
	global $optionsSaved;

	$options = ukikusa_get_options();
	if ( $optionsSaved )
		echo '<div id="message" class="updated fade"><p><strong>'.__('オプションの更新に成功しました。', 'ukikusa').'</strong></p></div>';
?>

<div class="wrap">

<h2><?php _e('ukikusa_info option', 'ukikusa'); ?></h2>

<form method="post" action="#" enctype="multipart/form-data">

<p><input class="button-primary" type="submit" name="ukikusa_save_options" value="<?php _e('Save Changes', 'ukikusa'); ?>" /></p>
<br />

<p><?php _e('タイトルにロゴ画像を利用しますか？利用する場合には<strong>wp-content/themes/ukikusa/img/</strong>にファイルを配置してください。', 'ukikusa'); ?></p>
<p><input name="use_logo" type="checkbox" value="checkbox" <?php if($options['use_logo']) echo "checked='checked'"; ?> /> <?php _e('Yes', 'ukikusa'); ?></p>
<p><?php _e('ロゴ画像名を指定してください。', 'ukikusa'); ?></p>
<p><input type="text" name="logo_name" value="<?php echo($options['logo_name']); ?>" /></p>

<p><?php _e('twitter-ID.', 'ukikusa'); ?></p>
<p><input type="text" name="twitter" value="<?php echo($options['twitter']); ?>" /></p>
<p><?php _e('facebook-ID.', 'ukikusa'); ?></p>
<p><input type="text" name="facebook" value="<?php echo($options['facebook']); ?>" /></p>
<p><?php _e('mixi-ID.', 'ukikusa'); ?></p>
<p><input type="text" name="mixi" value="<?php echo($options['mixi']); ?>" /></p>
<p><?php _e('github-ID.', 'ukikusa'); ?></p>
<p><input type="text" name="github" value="<?php echo($options['github']); ?>" /></p>



<p><?php _e('広告枠に表示するHTMLタグ ( HTML tag is available. )', 'ukikusa'); ?></p>
<p><textarea name="adsense" cols="70%" rows="5"><?php echo($options['adsense']); ?></textarea></p>
</div>

<p><input class="button-primary" type="submit" name="ukikusa_save_options" value="<?php _e('Save Changes', 'ukikusa'); ?>" /></p>

</form>

</div>

<?php
  }

// register function
add_action('admin_menu', 'ukikusa_create_options');
add_action('admin_menu', 'ukikusa_add_theme_options');
 
?>
