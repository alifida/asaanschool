<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pre')) {

    function pre($var = '') {
        echo "<pre>";
        print_r ($var);
        echo "</pre>";
    }

}

if (!function_exists('pre_d')) {

    function pre_d($var = '') {
        pre($var);
        die();
    }

}