<?php include('/srv/www/main/public_html/wp-blog-header.php');
 header("HTTP/1.1 200 OK");
 
if(!isset($_GET['parent_id']) || !isset($_GET['child_id']) || !is_numeric($_GET['child_id']) || !is_numeric($_GET['parent_id']))
     die();
 $parent_id = $_GET['parent_id']
 $attachments = get_children( array( 'post_parent' => $parent_id, 'post_type' => 'attachment' ) );
 $valid = false;
 $valid_attachment;
 foreach($attachments as $attachment):
    if ( strpos( $attachment->post_mime_type, 'image/' ) !== 0 )
        return;
    if ($attachment->ID == $_GET['child_id']){
        $valid = true;
        $valid_attachment = $attachment;
    }
 endforeach;
 
 if(!$valid)
     return;
 preg_match('/\[name\](.*)\[\/name\]/', $valid_attachment->post_content, $matched_title);
 preg_match('/\[year\](.*)\[\/year\]/', $valid_attachment->post_content, $matched_year);
 preg_match('/\[video\](.*)\[\/video\]/', $valid_attachment->post_content, $matched_video);
 preg_match('/\[blurb\](.*)\[\/blurb\]/', $valid_attachment->post_content, $matched_blurb);
 $title = "";
 $year = "";
 $blurb = "";
 $video = "";
 if(isset($matched_title[1]))
     $title = $matched_title[1];
 if(isset($matched_year[1]))
     $year = $matched_title[1];
 if(isset($matched_blurb[1]))
     $blurb = $matched_blurb[1];
 if(isset($matched_video[1]))
     $video = $matched_video[1];
?>

 <div id="eg-single-person" style="">
	<div id="eg-content-right">
                <h1 class="eg-light-header"><?php echo $title; ?></h1>
                <h2 class="eg-light-position"><?php echo $year; ?></h2>
                <p><?php echo $blurb; ?></p>
        </div>
	 <div id="eg-video-left" style="display:block">
        <?php echo $video; ?>
	</div>
 </div>
