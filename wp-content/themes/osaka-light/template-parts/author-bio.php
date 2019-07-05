<?php if ( (bool) get_the_author_meta( 'description' ) ) : ?>

    <div class="author-bio media">
        <div class="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
        </div><!-- /.author-avatar -->

        <div class="author-details media-body">
            <h4 class="name">
                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                    <?php echo esc_html( get_the_author() );?>
                </a>
            </h4>
            <p>
                <?php the_author_meta( 'description' ); ?>
            </p>
        </div><!-- /.author-details -->
    </div><!-- /.author-bio -->

<?php endif; ?>