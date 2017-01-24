<?php

require(sprintf(
	'%s/conf/start.php',
	dirname(__FILE__,2)
));

try {
	(new App\Router)
	->Run();
}

catch(Throwable $Error) {
	echo "Page not found most likely bruh.";
}
