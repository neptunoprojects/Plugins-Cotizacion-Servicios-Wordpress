<?php



function queryall ($tabla){
    global $wpdb, $results;
    $tabla = $wpdb->prefix . $tabla;

    $results = $wpdb->get_results(
        "SELECT * FROM  $tabla"
    );
}



function query ($tabla, $paginas){
    global $wpdb, $results;
    $tabla = $wpdb->prefix . $tabla;
    $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
    $limit =  $paginas;
    $offset = ($pagenum - 1) * $limit;
    

    $results = $wpdb->get_results(
        "SELECT * FROM  $tabla  LIMIT $offset, $limit"
    );

    

}

function paginacion($tabla, $paginas)
{
    global $wpdb, $results;
    $tabla = $wpdb->prefix . $tabla;
    $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
    $limit =  $paginas;
    $offset = ($pagenum - 1) * $limit;

    $total = $wpdb->get_var("SELECT COUNT(`id`) FROM  $tabla");
    $num_of_pages = ceil($total / $limit);
    $page_links = paginate_links(array(
        'base' => add_query_arg('pagenum', '%#%'),
        'format' => '',
        'prev_text' => __('&laquo;', 'aag'),
        'next_text' => __('&raquo;', 'aag'),
        'total' => $num_of_pages,
        'current' => $pagenum
    ));

    if ($page_links) {
        echo '<div class="tablenav"><div class="tablenav-pages">' . $page_links . '</div></div>';
    }
 
}
 