<?php
$aria_req = ( $req ? " aria-required='true'" : '' );
$ksasfields =  array(
	'author' => '<p class="comment-author">' . '<label for="author">' . __( 'Your name:' ) . '</label> ' . ( $req ? '' : '' ) .
	            '<input id="author" name="author" type="text" ' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-email"><label for="email">' . __( 'Email:' ) . '</label> ' . ( $req ? '' : '' ) .
	            '<input id="email" name="email" type="text" ' . $aria_req . ' /></p>',
);
 
$ksascomments = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $ksasfields ),
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'comment_field'		   => '<p class="comment-comment"><label for="comment">' . _x( 'Comment:', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'must_log_in'          => '',
	'logged_in_as'         => '',
	'title_reply'          => __( '' ),
	'title_reply_to'       => __( 'Leave a Reply to %s' ),
	'cancel_reply_link'    => __( 'Cancel reply' ),
	'label_submit'         => __( 'Submit Comment' ),
);

?>
		<div class="comments">
			<!-- Standard <ul> with class of "tabs" --> 
			<ul class="tabs"> 
			<!-- Give href an ID value of corresponding "tabs-content" <li>'s -->
				<li><a href="#empty" style="display:none"></a></li>								  
			    <li><a href="#view_comments"><?php comments_number( 'No Current Comments', 'View Comment', 'View Comments (%)' ); ?></a></li>								  
			    <li><a href="#post_comment">Post Your Comment</a></li>								  
			</ul>
			
			<ul class="tabs-content"> 
			<!-- Give ID that matches HREF of above anchors -->
			    <li class="active" id="empty" style="display:none"> 
			    </li>
			    
			    <li id="view_comments">
			    	<div class="commentlist"><?php wp_list_comments(array('style' => 'div', 'callback' => 'asmag_comment')); ?></div>
			    </li>
			    
			    <li id="post_comment">
			    	<?php comment_form($ksascomments); ?>
			    </li>
			</ul>
		</div>


	    				
