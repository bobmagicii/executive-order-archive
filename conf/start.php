<?php

define('ProjectRoot',dirname(__FILE__,2));
define('WebRoot',sprintf('%s/www',ProjectRoot));
define('CacheRoot',sprintf('%s/cache',CacheRoot));

require(sprintf(
	'%s/vendor/autoload.php',
	ProjectRoot
));
