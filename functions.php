<?php

/** Initialization */
include_once 'functions/init.php';

/** Theme functions */
include_once 'functions/custom/backend.php';
include_once 'functions/custom/tinymce.php';
include_once 'functions/custom/enqueue.php';
include_once 'functions/custom/theme-support.php';
include_once 'functions/custom/menus.php';
include_once 'functions/custom/body-class.php';
include_once 'functions/custom/wp-title.php';
include_once 'functions/custom/image-size.php';
include_once 'functions/custom/views.php';
include_once 'functions/custom/acf.php';
include_once 'functions/custom/google-map.php';

$dir = dirname(__FILE__) . '/functions';
includeFiles("$dir/options");
includeFiles("$dir/posttypes");
includeFiles("$dir/shortcodes");
includeFiles("$dir/ajax");
