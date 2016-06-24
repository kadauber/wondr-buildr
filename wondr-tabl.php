<?php
// IMPORTANT: Must require literal path to config.php first
// in every reachable file in order to properly configure webpages
require_once 'resources/config.php';
require_once LIBRARY_PATH . "/template_functions.php";

// Render the wonder table view as the main page
render_layout_with_content_file("wonderTable.php");
?>
