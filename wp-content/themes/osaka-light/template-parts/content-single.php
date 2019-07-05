
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-top">            
            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
            <div class="post-meta">
				<?php
					osaka_light_posted_on();
					osaka_light_posted_by();
				?>
            </div><!-- /.post-meta -->
        </div><!-- /.post-top -->

		<?php osaka_light_post_thumbnail(); ?>

        <div class="entry-content">

            <?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'osaka-light' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
				    'before' => '<p>' . esc_html__('Pages:', 'osaka-light'),
				    'after' => '</p>',
				    'next_or_number' => 'next_and_number', # activate parameter overloading
				    'nextpagelink' => esc_html__('Next', 'osaka-light'),
				    'previouspagelink' => esc_html__('Previous', 'osaka-light'),
				    'pagelink' => '%',
				    'echo' => 1 					
				) );
			?>


            <div class="tags">
                <?php osaka_light_entry_footer();?>
            </div><!-- /.tags -->

            

        </div><!-- /.entry-content -->
    </article><!-- /.post -->
