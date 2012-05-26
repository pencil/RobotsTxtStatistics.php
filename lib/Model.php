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
  
  public static function getTop($limit = null, $timestampStart = null, $timestampEnd = null) {
    $pdo = Db::getPdoInstance();
    $statement = $pdo->prepare('SELECT name, timestamp as last_request, COUNT(*) AS total_requests FROM requests GROUP BY name ORDER BY total_requests DESC, last_request DESC LIMIT :limit');
    $statement->bindValue(':limit', $limit === null ? 30 : $limit, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }
}