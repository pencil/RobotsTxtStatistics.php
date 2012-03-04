<?php

class UserAgent {
  
  private static $_browsers = null;
  
  public static function getBrowserList() {
    if(self::$_browsers !== null) {
      return self::$_browsers;
    }
    $pathData = 'data/php_browscap.ini';
    $pathCache = 'cache/browsercap';
    $validCache = file_exists($pathCache) && filemtime($pathData) <= filemtime($pathCache);
    if($validCache) {
      $browsers = unserialize(file_get_contents($pathCache));
      $validCache = !!$browsers;
    }
    if(!$validCache) {
      if (version_compare(phpversion(), '5.3.0', '>=')) {
        $browsers = parse_ini_file($pathData, true, INI_SCANNER_RAW);
      } else {
        $browsers = parse_ini_file($pathData, true);
      }
      foreach($browsers as &$browser) {
        foreach($browser as $key => &$value) {
          if($value === 'false') {
            $value = false;
          } else if($value === 'true') {
            $value = true;
          }
        }
      }
      file_put_contents($pathCache, serialize($browsers), LOCK_EX);
    }
    self::$_browsers = $browsers;
    return $browsers;
  }
  
  public static function getInformation($userAgent) {
    $startTime = microtime(true);
    $browsers = self::getBrowserList();
    echo 'Took ' . (microtime(true) - $startTime) . 's';
    $matchedBrowser = null;
    foreach($browsers as $pattern => $browser) {
      if(fnmatch($pattern, $userAgent)) {
        $matchedBrowser = $browser;
        while(!empty($browser['Parent'])) {
          $browser = $browsers[$browser['Parent']];
          $matchedBrowser = array_merge($browser, $matchedBrowser);
        }
        break;
      }
    }
    return $matchedBrowser;
  }
}