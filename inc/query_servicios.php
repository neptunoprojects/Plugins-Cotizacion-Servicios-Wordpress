<?php
global $wpdb;

$results = $wpdb->get_results(
	"SELECT * FROM  {$wpdb->prefix}servicios"
);

$post_per_page = 10;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset = ( $page * $post_per_page ) - $post_per_page;