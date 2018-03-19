<?php

if (!function_exists('build_response')) {
	function build_response($status, $message) {
        $data = array(
        	'status' => $status,
        	'message' => $message
        );

        return $data;
    }
}