<?php
require_once 'resources/config.php';

// Renders content of contentFile surrounded by header and footer
// contentFile must be the (string) name of a file located in resources/templates
// (not including the preceding /)
function render_layout_with_content_file($contentFile) {
    $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;

    // include the header
    require_once TEMPLATES_PATH . "/header.php";

    // open a div for the content container
    echo "<div id=\"container\">\n";
    // open a div for the content
    echo "\t<div id=\"content\">\n";

    // try to include the intended content
    if (file_exists($contentFileFullPath)) {
	require_once $contentFileFullPath;
    } else {
	// if the file isn't there, display an error instead
	require_once TEMPLATES_PATH . "/error.php";
    }

    // close the content div
    echo "\t</div>\n";

    // INCLUDE OTHER ALWAYS-THERE THINGS IN THIS SPOT,
    // E.G. LEFT AND RIGHT PANELS, WITH LINES LIKE THE FOLLOWING
    // require_once TEMPLATES_PATH . "/rightPanel.php";
    // require_once TEMPLATES_PATH . "/leftPanel.php";

    // close the content container div
    echo "</div>\n";

    // include the footer
    require_once TEMPLATES_PATH . "/footer.php";

}
