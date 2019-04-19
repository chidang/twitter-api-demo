<?php
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
  'oauth_access_token' => "YOUR_OAUTH_ACCESS_TOKEN",
  'oauth_access_token_secret' => "YOUR_OAUTH_ACCESS_TOKEN_SECRET",
  'consumer_key' => "YOUR_CONSUMER_KEY",
  'consumer_secret' => "YOUR_CONSUMER_SECRET"
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
$data = json_decode($twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest(),$assoc = TRUE);

if(array_key_exists("errors", $data)) {
  echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$data[errors][0]["message"]."</em></p>";
  exit();
}

$followers_count = $data[0]['user']['followers_count'];

echo "<h3>Twitter - ". $followers_count ." followers</h3>";

foreach($data as $item)
{
  $text = explode('https', $item['text']);
  array_pop($text);
  $text = implode('/', $text);
  $url = $item['entities']['urls'][0]['expanded_url'];
  $link = "<a href='$url' target='_blank'>Read more</a></url>";

  echo "Time and Date of Tweet: ".$item['created_at']."<br />";
  echo "Tweet: ". $text . $link ."<br />";
  echo "Tweeted by: ". $item['user']['name']."<br />";
  echo "Screen name: ". $item['user']['screen_name']."<br />";
  echo "Followers: ". $item['user']['followers_count']."<br />";
  echo "Friends: ". $item['user']['friends_count']."<br />";
  echo "Listed: ". $item['user']['listed_count']."<br /><hr />";
}
