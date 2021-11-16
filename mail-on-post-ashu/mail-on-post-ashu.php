<?php 
	/**
	 * Plugin Name: mail on post ashu
	 * Description: mail on post ashu
	 * Author: Ashu
	 * Version: 1.0
	 */
    
function webroom_send_mail_on_new_post( $post_id, $post  ) {
    if ( strpos($_SERVER['HTTP_REFERER'], 'edit-question') !== false ) {
    } else {
		if(date("Y-m-d H:i", strtotime($post->post_date)) == date("Y-m-d H:i", strtotime($post->post_modified))){
			// send mail if the post is just published
			$headers = 'From: "'.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			
			$to = 'ashuji9296@gmail.com';
			$subject = 'New Post Published';
			$post_title = $post->post_title;
			$message = 'Hi, new post is published on <a href="'.get_home_url().'">'.get_home_url().'</a> <br/>
                            Title : ' . $post_title .' <br /> Url : <a href="'.$post->guid.'">'.$post->guid.'</a> ';
			
			wp_mail($to, $subject, $message, $headers);
		}
			
	}
}
add_action( 'publish_post', 'webroom_send_mail_on_new_post', 10, 3 );
?>