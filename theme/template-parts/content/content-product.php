<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  

        <?php
		the_content();
		
		?>
    </div><!-- .entry-content -->

</article><!-- #post-${ID} -->