<?php

require_once 'Db.php';
require_once 'UserAgent.php';

class Model {
  public static function captureRequest($ip, $userAgent) {
    $browserInformation = UserAgent::getInformation($userAgent);
    $pdo = Db::getPdoInstance();
    //if($browserInformation['Crawler']) {
    $statement = $pdo->prepare('INSERT INTO requests (timestamp, type, name, useragent) VALUES (?, ?, ?, ?)');
    $statement->execute(array(time(), $browserInformation['Crawler'] ? 'crawler' : 'browser', $browserInformation['Browser'], $userAgent));
    //}
  }
}