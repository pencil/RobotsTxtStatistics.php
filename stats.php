<?php

header('Content-Type: text/plain');

require_once 'lib/Model.php';
$format = '%-25s %-40s %20s' . "\n";

printf($format, 'NAME', 'LAST REQUEST', 'TOTAL REQUESTS');
foreach(Model::getTop(25) as $top) {
  printf($format, $top['name'], date('c', $top['last_request']), $top['total_requests']);
}