<?php

include_once('dbconnect.php');

$url = "https://quotefancy.com/";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
//echo $curl_scraped_page; //this will display the whole page

//fetching the title and link
preg_match_all(
    '/<div class="gridblock-title"><a href="(.*?)">(.*?)<\/a><\/div>/s',
    $curl_scraped_page,
    $topic, // will contain the article data
    PREG_SET_ORDER // formats data into an array of posts
);

//fetching the related tags here

foreach ($topic as $post) {
    $link = $post[1];
    $title = $post[2];
 
    //echo "<a href='" . $link . "'>" . $title . "</a><br>\n";
    echo " ".$link." - ".$title."\n";

    //already inserted in database
    //Database::inserttitle($link,$title);
}


?>