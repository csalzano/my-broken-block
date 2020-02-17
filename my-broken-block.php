<?php
/**
 * Plugin Name: My Broken Block
 * Description: My first attempt to create a block that updates a post meta value using the Developer Handbook.
 * Version: 0.0.1
 * Author: Corey Salzano
 * Author URI: https://profiles.wordpress.org/salzano
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function myguten_enqueue()
{
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php' );

	wp_enqueue_script(
		'myguten-script',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	register_block_type( 'myguten/test-block', array(
		'editor_script' => 'myguten-script',
	) );
}
add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );

function register_meta_field_for_post()
{
	//The meta key the block saves
	register_post_meta( 'post', 'block_meta_key', array(
		'sanitize_callback' => 'sanitize_text_field',
		'show_in_rest'      => true,
		'single'            => true,
		'type'              => 'string',
	) );

	/**
	 * This is another registered meta field that we won't use explicitly, but
	 * will be saved with a blank value any time our broken block is used. This
	 * was not expected behavior--a block should only save the field we tell it.
	 */
	register_post_meta( 'post', 'another_meta_key_1', array(
		'sanitize_callback' => 'sanitize_text_field',
		'show_in_rest'      => true, //toggle this to false to prevent the block from saving a blank value for this key
		'single'            => true,
		'type'              => 'string',
	) );

	/**
	 * This is another registered meta field that we won't use explicitly, but
	 * will be saved with a blank value any time our broken block is used. This
	 * was not expected behavior--a block should only save the field we tell it.
	 */
	register_post_meta( 'post', 'another_meta_key_2', array(
		'sanitize_callback' => 'sanitize_text_field',
		'show_in_rest'      => true, //toggle this to false to prevent the block from saving a blank value for this key
		'single'            => true,
		'type'              => 'string',
	) );
}
add_action( 'init', 'register_meta_field_for_post' );
