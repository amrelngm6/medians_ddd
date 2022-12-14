<?php



/*
// Return 
// List of side menu
*/
function getMenuList()
{
	$data = array(
		array('title'=>'Dashboard', 'link'=>'dashboard'),
		array('title'=>'Properties', 'link'=>'', 'sub'=>
			[
				array('title'=>'Properties list', 'link'=>'properties'),
			]
		),
        // array('title'=>'Social', 'link'=>'', 'sub'=>
        //     [
        //         array('title'=>'FB Pages list', 'link'=>'fb/pages_list'),
        //     ]
        // ),
		array('title'=>'Settings', 'link'=>'settings'),
		array('title'=>'Logout', 'link'=>'logout'),
	);

	return $data;
}



/**
 * Page not found 
 * @param Object $twig, Object $app 
 * @return Page not found template 
 */
function Page404($twig, $app)
{
    return $twig->render('views/404.html.twig', [
        'title' => 'Page not found',
        'app' => $app
    ]);
}


/**
 * Page not authorized 
 * @param Object $twig, Object $app 
 * @return Page not found template 
 */
function Page403($twig, $app)
{
    return $twig->render('views/admin/404.html.twig', [
        'title' => 'Not authorized to acces this Page.',
        'app' => $app
    ]);
}



/**
* Handle routes response 
* based on session & Permissions
*/
function response($response, $app, $twig)
{

	return isset($app->providerSession->id) ? $response : Page403($twig, $app);

}