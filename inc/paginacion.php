<?php 


$items_per_page = 2;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset = ( $page * $items_per_page ) - $items_per_page;


$total_query = "SELECT COUNT(1) FROM (${results}) AS combined_table";
$total = $wpdb->get_var( $total_query );

$results = $wpdb->get_results( $results.' ORDER BY id DESC LIMIT '. $offset.', '. $items_per_page, OBJECT );

echo paginate_links( array(
    'base' => add_query_arg( 'cpage', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($total / $items_per_page),
    'current' => $page
));
?>