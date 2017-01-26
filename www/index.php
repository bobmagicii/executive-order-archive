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

// run the application.

$Router = new App\Site\Router;
Nether\Stash::Set('Router',$Router);

try { $Router->Run(); }
catch(Throwable $Error) {
	echo "Page not found most likely bruh.";
	exit(2);
}
