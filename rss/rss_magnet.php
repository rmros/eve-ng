<?php
/*
************************************
Filename: rss_magnet.php
Description: Relocates magnet links (as a hack because RSS doesn't work with magnet links)
*************************************
*/
$magnet  = (isset($_GET['magnet']))? $_GET['magnet']:'';
if ($magnet) {
    header('Location: magnet:'.urldecode($magnet));
} else {
    die('No link provided');
}
?>
