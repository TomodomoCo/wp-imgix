<?php
/**
 * Plugin Name: Tomodomo WP Imgix
 * Plugin URL: https://tomodomo.co/
 * Description: Custom tools for using Imgix in a WordPress context
 * Version: 1.0.0
 * Author: Tomodomo
 * Author URI: https://tomodomo.co/
 * License: MIT
 */

namespace Tomodomo\Plugin\WP_Imgix;

// Functions
require 'src/functions.php';

// Integrations
include 'src/integrations/wp-api.php';
