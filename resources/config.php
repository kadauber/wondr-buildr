<?php
/*
 * When in production, this file should be moved to ~/web_scripts_config.php
 */

set_include_path(".:");

// Database login details
define("DATABASE_HOST", "sql.mit.edu");
define("USERNAME", "kadauber");
define("PASSWORD", "racetoillumination");
define("DATABASE", "kadauber+Wonders");

// Constant names for heavily used paths
defined("LIBRARY_PATH") or define("LIBRARY_PATH", realpath(__DIR__) . '/library');
defined("TEMPLATES_PATH") or define ("TEMPLATES_PATH", realpath(__DIR__) . '/templates');
?>
