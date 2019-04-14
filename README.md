twitter-api-php-demo
===============

Simple PHP Wrapper for Twitter API v1.1 calls

The aim of this class is simple. You need to:

- [Create a twitter app on the twitter developer site](https://dev.twitter.com/apps/)
- Enable read/write access for your twitter app
- Grab your access tokens from the twitter developer site

You really can't get much simpler than that. The above bullet points are an example of how to use the class for a POST request to block a user, and at the bottom is an example of a GET request.


How To Use
----------

#### Set access tokens ####

```php
$settings = array(
    'oauth_access_token' => "YOUR_OAUTH_ACCESS_TOKEN",
    'oauth_access_token_secret' => "YOUR_OAUTH_ACCESS_TOKEN_SECRET",
    'consumer_key' => "YOUR_CONSUMER_KEY",
    'consumer_secret' => "YOUR_CONSUMER_SECRET"
);
```
Upload source code into your host and enjoy it.

That is it! Really simple, works great with the 1.1 API. Thanks to @j7mbo, @lackovic10 and @rivers!
