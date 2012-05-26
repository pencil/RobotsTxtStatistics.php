<?php

require_once 'lib/Model.php';

Model::captureRequest($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);

header('Content-Type: text/plain');
if(is_readable('data/robots.txt')) {
  readfile('data/robots.txt');
}