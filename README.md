RobotsTxtStatistics.php
=======================
This script tracks requests to your website's robots.txt and generates statistics based on the recorded data.

Output
------
The output is at the moment very simple and nothing special. It's just a (plain text) list of the top 25 browsers ordered by the number of requests:

    NAME                      LAST REQUEST                                   TOTAL REQUESTS
    msnbot-NewsBlogs          2012-05-26T18:04:35+02:00                                  13
    BaiDu                     2012-05-27T06:10:39+02:00                                   6
    Exabot/BiggerBetter       2012-05-27T01:46:11+02:00                                   5
    Ezooms                    2012-05-26T23:05:42+02:00                                   3
    [...]

Installation
------------
1. Download the php_browscap.ini from the [Browser Capabilities Project](http://browsers.garykeith.com/downloads.asp) to data/php_browscap.ini
2. Create a database, load setup/schema.sql and configure the connection in config/db.php.
3. Copy the content of your original robots.txt to data/robots.txt
4. Upload everything to your website's root folder and name the folder robots.txt (instead of RobotsTxtStatistics.php)
5. Visit http://example.com/robots.txt
6. Visit http://example.com/robots.txt/stats.php