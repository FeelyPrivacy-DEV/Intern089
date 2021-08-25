<?php

require 'vendor/autoload.php';
use Auth0\SDK\Auth0;

$auth0 = new Auth0([
  'domain' => 'dev-83yti7ke.us.auth0.com',
  'client_id' => 'wxoAs08d4cn6d5XsJXRVtvUKUrZg96lx',
  'client_secret' => 'cN2pt5bJtf1qSI5-Nc7LIDtdQOETadbAxUxbjCREA8kw1mRxt6c-0gEA1yVbNct1',
  'redirect_uri' => 'http://pavan.co/s/s/index',
  'scope' => 'openid profile email',
]);

$auth0->login();


?>