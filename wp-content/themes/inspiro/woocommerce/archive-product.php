<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<div class="wrap wrap--layout-<?php echo esc_attr( option::get( 'layout_shop' ) ); ?>">

    <h2 class="section-title"><?php woocommerce_page_title(); ?></h2>

    <main id="main" class="site-main" role="main">

        <section class="products-archive">

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php

                do_action('woocommerce_output_content_wrapper');
            ?>

            <?php if ( have_posts() ) : ?>

                <?php
                    /**
                     * woocommerce_before_shop_loop hook
                     *
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template_part( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>

        </section><!-- .recent-posts -->

    </main><!-- .site-main -->

    <?php if ( option::get( 'layout_shop' ) !== 'full' && is_active_sidebar( 'sidebar-shop' ) ) : ?>

        <div class="sidebar sidebar--shop">

            <?php dynamic_sidebar( 'sidebar-shop' ); ?>

        </div>

    <?php endif; ?>

</div><!-- .main-wrap -->

<?php
get_footer( 'shop' );