<?php

// load up the configuration.

try {
	require(sprintf(
		'%s/conf/start.php',
		dirname(__FILE__,2)
	));
}

catch(Throwable $Error) {
	echo $Error->GetMessage();
	exit(1);
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// boot up some libraries.

new Nether\Surface;

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// run the application.

try {
	(new App\Router)
	->Run();
}

catch(Throwable $Error) {
	echo "Page not found most likely bruh.";
	exit(2);
}
