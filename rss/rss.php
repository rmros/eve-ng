<?php
/*
************************************
Filename: rss.php (can be anything you like)
Description: Uses ?search= GET parameter to search The Pirate Bay and displays results as RSS feed.
*************************************
*/
$PirateDomain = 'https://thepiratebay.org'; // No trailing slash please!
$search  = (isset($_GET['search']))? $_GET['search']:'';
if ($search) {
    $content = file_get_contents($PirateDomain.'/search/'.$search);
    if (preg_match('/<table id="searchResult">.*?<\/table>/is', $content, $table)) {
        preg_match_all('/<div class="detName">.*?<a href="(.*?)".*?>(.*?)<\/a>.*?<a href="magnet:([^"]*).*?Uploaded (.{1,20}), Size (.{1,30}),.*?class="detDesc".*?>(.*?)<\/a>.*?<td .*?>([0-9]{1,8}).*?<td .*?>([0-9]{1,8})/is', $table[0], $matches, PREG_SET_ORDER);
    }
    unset($content);
}
 
header("Content-type: text/xml");
?>
<?xml version="1.0" encoding="ISO-8859-1"?>
<rss version="2.0">
    <channel>
        <title>Unofficial Pirate Bay RSS - <?php echo $search; ?></title>
        <link><?php echo $PirateDomain; ?></link>
        <description>Pirate Bay scraper</description>
        <language>en-us</language>
        <?php
        if (isset($matches)) {
            foreach ($matches as $match) {
                echo '<item>';
                echo '<title>'.$match[2].'</title>';
                echo '<description>Size: '.html_entity_decode($match[5]).', Uploaded by: '.html_entity_decode($match[6]).', Seeders: '.html_entity_decode($match[7]).', Leechers: '.html_entity_decode($match[8]).'</description>';
                echo '<link>'.$PirateDomain.$match[1].'</link>';
                echo '<pubDate>'.html_entity_decode($match[4]).'</pubDate>';
                echo '<enclosure url="http'.(isset($_SERVER['HTTPS'])? 's':'').'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/rss/rss_magnet.php?magnet='.urlencode($match[3]).'" type="application/x-bittorrent" length="10000" />';
                echo "</item>\n";
            }
        }
        ?>
    </channel>
</rss>
