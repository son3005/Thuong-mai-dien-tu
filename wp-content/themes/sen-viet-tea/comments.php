<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="custom-comments-area">

	<?php
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$sen_viet_tea_comment_count = get_comments_number();
			if ( '1' === $sen_viet_tea_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( '1 bình luận', 'sen-viet-tea' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s bình luận', '%1$s bình luận', $sen_viet_tea_comment_count, 'comments title', 'sen-viet-tea' ) ),
					number_format_i18n( $sen_viet_tea_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation(
            array(
                'prev_text' => '← Bình luận cũ hơn',
                'next_text' => 'Bình luận mới hơn →',
            )
        );

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Bình luận đã đóng.', 'sen-viet-tea' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
        array(
            'title_reply'          => 'Để lại bình luận',
            'title_reply_to'       => 'Trả lời %s',
            'cancel_reply_link'    => 'Hủy trả lời',
            'label_submit'         => 'Gửi bình luận',
            'comment_notes_before' => '<p class="comment-notes">Email của bạn sẽ không được hiển thị công khai. Các trường bắt buộc được đánh dấu *</p>',
            'class_submit'         => 'btn submit-comment',
            'comment_field'        => '<div class="comment-form-comment"><label for="comment">Bình luận <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required" placeholder="Viết bình luận của bạn tại đây..."></textarea></div>',
            'fields'               => array(
                'author' => '<div class="comment-form-author"><label for="author">Tên <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr( isset($commenter['comment_author']) ? $commenter['comment_author'] : '' ) . '" size="30" maxlength="245" required="required" placeholder="Tên của bạn" /></div>',
                'email'  => '<div class="comment-form-email"><label for="email">Email <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr( isset($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '' ) . '" size="30" maxlength="100" required="required" placeholder="Địa chỉ email" /></div>',
            ),
        )
    );
	?>

</div><!-- #comments -->

<style>
/* Comments Area Styling */
.custom-comments-area {
    margin-top: var(--spacing-xl);
    padding: 40px;
    background: var(--color-white, #fff);
    border-radius: var(--radius-lg, 16px);
    border: 1px solid var(--color-border-light, #e8e0d5);
    box-shadow: var(--shadow-sm, 0 2px 16px rgba(0,0,0,.04));
}
@media (max-width: 600px) {
    .custom-comments-area {
        padding: 24px;
    }
}

.comments-title {
    font-family: var(--font-heading);
    font-size: 1.6rem;
    color: var(--color-primary);
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--color-border-light);
}

.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment-list .comment {
    margin-bottom: 30px;
}
.comment-list .comment:last-child {
    margin-bottom: 0;
}

.comment-body {
    display: flex;
    gap: 20px;
}
@media (max-width: 600px) {
    .comment-body {
        flex-direction: column;
        gap: 12px;
    }
}

.comment-author.vcard img {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
    border: 2px solid var(--color-border-light);
}

.comment-meta {
    margin-bottom: 10px;
}
.comment-meta .fn {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--color-primary);
    font-style: normal;
}
.comment-meta .fn a {
    color: inherit;
    text-decoration: none;
}
.comment-metadata {
    font-size: 0.85rem;
    color: var(--color-text-light);
    margin-top: 4px;
}
.comment-metadata a {
    color: inherit;
    text-decoration: none;
}

.comment-content {
    line-height: 1.7;
    color: var(--color-text);
    background: var(--color-bg, #f9f6f0);
    padding: 20px;
    border-radius: 0 12px 12px 12px;
    flex: 1;
}
.comment-content p:last-child {
    margin-bottom: 0;
}

.reply {
    margin-top: 12px;
}
.reply a {
    display: inline-block;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
    transition: color 0.2s;
}
.reply a:hover {
    color: var(--color-primary);
}

.comment-list .children {
    list-style: none;
    padding-left: 0;
    margin-top: 30px;
    margin-left: 80px;
    border-left: 2px solid var(--color-border-light);
    padding-left: 30px;
}
@media (max-width: 600px) {
    .comment-list .children {
        margin-left: 20px;
        padding-left: 15px;
    }
}

/* Form Styling */
.comment-respond {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid var(--color-border-light);
}

.comment-reply-title {
    font-family: var(--font-heading);
    font-size: 1.4rem;
    color: var(--color-primary);
    margin-bottom: 10px;
}

.comment-notes {
    font-size: 0.9rem;
    color: var(--color-text-light);
    margin-bottom: 24px;
}

.comment-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.comment-form-comment {
    grid-column: 1 / -1;
}

.comment-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--color-primary);
    font-size: 0.95rem;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--color-border-light);
    border-radius: 8px;
    background: #fff;
    font-family: inherit;
    color: var(--color-text);
    transition: border-color 0.2s, box-shadow 0.2s;
}
.comment-form input[type="text"]:focus,
.comment-form input[type="email"]:focus,
.comment-form textarea:focus {
    outline: none;
    border-color: var(--color-secondary);
    box-shadow: 0 0 0 3px rgba(107, 143, 113, 0.1);
}

.form-submit {
    grid-column: 1 / -1;
    margin-top: 10px;
}

.submit-comment {
    background: var(--color-secondary);
    color: #fff;
    border: none;
    padding: 12px 28px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
}
.submit-comment:hover {
    background: var(--color-primary);
    transform: translateY(-2px);
}
.submit-comment:active {
    transform: translateY(0);
}

/* Remove default cookies consent styling if it exists */
.comment-form-cookies-consent {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: var(--color-text-light);
}
.comment-form-cookies-consent label {
    margin-bottom: 0;
    font-weight: normal;
}
</style>
