<?php

/**
 * @package WN Elementor Glassy
 */
/*
Plugin Name: WN Elementor Glassy Columns
Plugin URI: https://wirenomads.com
Description: This Elementor addon is the first of its kind, and it apply a glassmorphism effect to the Elementor columns, making it looks great which will keep your development skills up to date with latest design trends. 
Author: Yaidier Perez
Version: 1.0
Author URI: 
License: GPLv2 or later
*/
/*
Copyright (C) 2020  Yaidier Perez

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
if (!defined('ABSPATH')) {
    exit;
}

define('WN_ELEMENTOR_GLASSY_DIR', __DIR__);
define('WN_ELEMENTOR_GLASSY_URL', plugin_dir_url(__FILE__));
define('WN_ELEMENTOR_GLASSY_VERSION', '1.0');

function load_wn_elementor_glassy()
{
    require_once WN_ELEMENTOR_GLASSY_DIR . '/assets/elementor-widget/my-widgets.php';
}

class Wn_Elementor_Glassy
{
    public $my_plugin_name;
    function __construct()
    {
        $this->my_plugin_name = plugin_basename(__FILE__);
    }

    function register()
    {
        add_action('elementor/init', 'load_wn_elementor_glassy');
    }

    function activate()
    {
    }

    function deactivate()
    {
    }

    function uninstall()
    {
        // delete_option('WN_Image_Hover');
    }
}

if (class_exists('Wn_Elementor_Glassy')) {
    $wn_elementor_glassy = new Wn_Elementor_Glassy();
    $wn_elementor_glassy->register();
}

//activation
register_activation_hook(__FILE__, array($wn_elementor_glassy, 'activate'));
//deactivation
register_deactivation_hook(__FILE__, array($wn_elementor_glassy, 'deactivate'));
//uninstall
// register_unisntall_hook( __FILE__, array($wn_elementor_glassy, 'uninstall'));
