<?php
global $wpdb;

$results = $wpdb->get_results(
	"SELECT * FROM  {$wpdb->prefix}servicios_cotizacion"
);
