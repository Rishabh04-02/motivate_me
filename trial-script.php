<?php
include_once('dbconnect.php');

//inserting id in database
	for ($i=0; $i < 96; $i++) { 
		$j=100+$i;
		Database::assignid($j);
	}


//fetching and putting contents in file
    
$file = 'abc.txt';
echo "its working\n";
//fetching the div elements for post tags
$url = "https://quotefancy.com/";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
//echo $curl_scraped_page; //this will display the whole page

preg_match_all(
    '/<div class="gridblock-title">(.*?)<div class="gridblock-footer">/s',
    $curl_scraped_page,
    $topic, // will contain the article data
    PREG_SET_ORDER // formats data into an array of posts
);

foreach ($topic as $post) {
    $link = $post[1];
 	$pup = "$link\n";
    //echo "<a href='" . $link . "'>" . $title . "</a><br>\n";
    echo " ".$link."\n";

    // Write the contents back to the file
	file_put_contents($file, $pup, FILE_APPEND | LOCK_EX);

    //already inserted in database
    //Database::inserttitle($link,$title);
}


//replacing the title with id in database

    $lines = file('abc.txt');
    
    for ($i=0; $i < 186; $i=$i+2) { 
        $title = $lines[$i];
        $title = str_replace(array("\r\n", "\n", "\r"), ' ', $title);
        $ret = Database::getid($title);

        $lines[$i] = $ret;
    }


    file_put_contents('abc.txt', $lines);


//insert tags in tags table

    $lines = file('abc.txt');
    
    for ($i=1; $i < 178; $i=$i+2) { 
        $string = $lines[$i];
        $string = str_replace(' ',"\n",$string);
        echo $string;

        $lines[$i] = $string;
    }

    file_put_contents('abc.txt', $lines);


//script for inserting tags in database

$number = 0;
foreach(file('abc.txt') as $line) {
    $line = preg_replace( "/\r|\n/", "", $line );
    if(is_numeric($line))   {
        $number = $line;
    }
    else    {
        echo $number." - ".$line."\n";
        $ret = Database::addtags($number,$line);
    }
}
?>
