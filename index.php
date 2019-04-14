<?php
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
  'oauth_access_token' => "YOUR_OAUTH_ACCESS_TOKEN",
  'oauth_access_token_secret' => "YOUR_OAUTH_ACCESS_TOKEN_SECRET",
  'consumer_key' => "YOUR_CONSUMER_KEY",
  'consumer_secret' => "YOUR_CONSUMER_SECRET"
);

$settings = array(
'oauth_access_token' => "491966407-PHpN5Z0hNBk2EI9N1TW8TXZF5AkQ0O1avSa0awdL",
'oauth_access_token_secret' => "8i7GpbIAUgkoBopJUsitYazHRMsgqXyfR5SYGIW8zvgyB",
'consumer_key' => "vBNMCKDEeUaS2GnoF1Ef248f2",
'consumer_secret' => "N08YzPq7XthRRZnNLt8Y7KFSzKk65G3IIEAXcpaAzHCdBN42yZ"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
if (isset($_GET['user']))  {
  $user = preg_replace("/[^A-Za-z0-9_]/", '', $_GET['user']);
} else {
  $user  = "DangTanMinhChi";
}
if (isset($_GET['count']) && is_numeric($_GET['count'])) {
  $count = $_GET['count'];
} else {
  $count = 5;
}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if(array_key_exists("errors", $string)) {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
$followers_count = $string[0]['user']['followers_count'];
echo "<h3>Twitter - ". $followers_count ." </h3>";
foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
