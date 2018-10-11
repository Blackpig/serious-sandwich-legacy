<?php
// BACKEND CONFIG

// HTTP
define('HTTP_SERVER', 'http://www.serioussandwichpeopleltd.com/shop/admin/');
define('HTTP_CATALOG', 'http://www.serioussandwichpeopleltd.com/shop/');
define('HTTP_IMAGE', 'http://www.serioussandwichpeopleltd.com/shop/image/');
define('HTTP_ADMIN', 'http://www.serioussandwichpeopleltd.com/shop/admin/');

// HTTPS
define('HTTPS_SERVER', HTTP_SERVER);
define('HTTPS_CATALOG', HTTP_CATALOG);
define('HTTPS_IMAGE', HTTP_IMAGE);
define('HTTPS_ADMIN', HTTP_ADMIN);

// DIR
define('DIR_CATALOG', '/home/seriouss/public_html/shop/catalog/');
define('DIR_APPLICATION', '/home/seriouss/public_html/shop/admin/');
define('DIR_SYSTEM', '/home/seriouss/public_html/shop/system/');
define('DIR_DATABASE', DIR_SYSTEM.'database/');
define('DIR_LANGUAGE', DIR_APPLICATION.'language/');
define('DIR_TEMPLATE', DIR_APPLICATION.'view/template/');
define('DIR_CONFIG', DIR_SYSTEM.'config/');
define('DIR_IMAGE', '/home/seriouss/public_html/shop/image/');
define('DIR_CACHE', DIR_SYSTEM.'cache/');
define('DIR_DOWNLOAD', DIR_SYSTEM.'download/');
define('DIR_UPLOAD', DIR_SYSTEM.'upload/');
define('DIR_LOGS', DIR_SYSTEM.'logs/');
define('DIR_MODIFICATION', DIR_SYSTEM.'modification/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'seriouss_oc1');
define('DB_PASSWORD', 'Y(1*TIBWJORoNeOw~l]77^#1');
define('DB_DATABASE', 'seriouss_oc1');
define('DB_PREFIX', 'oc_');
define('DB_PORT', '3306');
?>