<?php
 /* 
 Template Name Posts: Election Grid
 */
 define('NO_SIDEBAR', true);
 global $long_path;
  $long_path = site_url().'/wp-content/themes/hatchet-main/election-grid';
 function add_election_scripts(){
 	global $long_path;
    echo "<link rel='stylesheet' id='gwh_election_style'  href='$long_path/styles/election-style.css' type='text/css' media='all' />";
	echo "<link rel='stylesheet' id='gwh_fancybox_style' href='$long_path/js/fancybox/jquery.fancybox-1.3.4.css' type='text/css' media='all' />";
        echo '<script type="text/javascript" src="'.$long_path.'/js/eg/election-js.js"></script>';
	//$path_to_photogrid = 'http://blogs.gwhatchet.com/wp-content/themes/hatchet-blogs/';
	$path_to_photogrid = '/js';
        echo '<script type="text/javascript" src="'.$long_path.$path_to_photogrid.'/fancybox/jquery.fancybox-1.3.4.js"></script>'."\n";
	echo '<script type="text/javascript" src="'.$long_path.$path_to_photogrid.'/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>'."\n";

 }
 add_action('wp_head', 'add_election_scripts');
 
 get_header();
?>
<!-- HTML GOES HERE -->
<div class="election-border-guides-top"></div>
<div id="election-guide-wrapper" class="clearfix">
<div id="election-guide-header-div">
	<a title="Election Guide 2012" class="election-guide-header" href="http://election.gwhatchet.com"><img src="<?php echo $long_path; ?>/i/eg/election-guide-small-header_220.jpg" /></a>
</div>
	<div id="election-grid">
		<img id="whats-at-stake-header" alt="What's At Stake?" src="<?php echo $long_path; ?>/i/eg/whats-at-stake-thin.jpg" />
		<?php 
$parent_id = get_the_ID();

$attachments = get_children( array( 'post_parent' => $parent_id, 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
$count = 0;
    foreach ( $attachments as $attachment ) {
        if ( strpos( $attachment->post_mime_type, 'image/' ) !== 0 )
            continue;
        $caption = $attachment->post_content;
        $credit = $attachment->post_excerpt;
        $url = $attachment->guid;
        preg_match('/files\/(\d{4}\/\d{2})/', $url, $matched_dates);
        $data = wp_get_attachment_metadata( $attachment->ID );
        if (isset($matched_dates[1])){
            //var_dump($data['sizes']);
            $grid_thumb_url = $data['sizes']['grid-thumb']['file'];
            $grid_large_url = $data['sizes']['grid-large']['file'];
            $height = $data['sizes']['grid-thumb']['height'];
            $thumb_url = home_url().'/files/'.$matched_dates[1].'/'.$grid_thumb_url;
            if(isset($grid_large_url))
                $large_url = home_url().'/files/'.$matched_dates[1].'/'.$grid_large_url;
            else
                $large_url = $url;		
            
			$mod_five = $count % 5; 
			$mod_two = $count % 2; 
			if($mod_five == 0): ?> 
			    <div style="clear:both">
			<?php endif; ?>
				<div class="eg-item">
					<a class="eg-image" href="/interactive/election-grid/ec-grid.php?parent_id=<?php echo $parent_id; ?>&child_id=<?php echo $attachment->ID; ?>" />
						<img class="transparent" src="<?php echo $url; ?>" alt="<?php echo $people[$mod_five][0]; ?>" />
						<div class="hidden photo-background"></div>
					</a>
				</div>
			<?php if($count % 5 == 0): ?>
				</div>
			<?php endif; ?>
		<?php $count++; } ?>
    <?php } ?>
	</div> <!-- End election-grid -->
</div> <!-- End election-guide-wrapper -->

  <?php if ( $author = get_post_meta( get_the_ID(), '_gwh_author', true ) ) : ?>
           <h4 class="author" style='font-size:16px;font-family:"Century Gothic", CenturyGothic, AppleGothic, sans-serif;color:#828282'>by <!-- <a href="" title=""><strong> --> <?php echo $author; ?> <!-- </strong></a> -->
           <!-- <br /> title -->
           </h4>
        <?php endif; ?>

<div class="election-border-guides-bottom"></div>


<!-- END HTML -->
<?php get_footer(); ?>
