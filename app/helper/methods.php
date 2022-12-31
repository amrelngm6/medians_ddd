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
                array('title'=>'Create Property', 'link'=>'properties/create'),
                array('title'=>'Rent items', 'link'=>'properties?request_type=rent'),
                array('title'=>'Sale items', 'link'=>'properties?request_type=sale'),
			]
		),
        array('title'=>'Users', 'link'=>'', 'sub'=>
            [
                array('title'=>'Administrators', 'link'=>'users/admin'),
                array('title'=>'Managers', 'link'=>'users/managers'),
                array('title'=>'Agents', 'link'=>'users/agents'),
            ]
        ),
        array('title'=>'Customers', 'link'=>'', 'sub'=>
            [
                array('title'=>'Customers', 'link'=>'customers/index'),
                array('title'=>'Create customer', 'link'=>'customers/create'),
            ]
        ),
        array('title'=>'Leads', 'link'=>'', 'sub'=>
            [
                array('title'=>'Leads ', 'link'=>'leads/index'),
                array('title'=>'Create lead', 'link'=>'leads/create'),
            ]
        ),
        array('title'=>'Contacts', 'link'=>'', 'sub'=>
            [
                array('title'=>'Contacts', 'link'=>'contacts/index'),
                array('title'=>'Create contact', 'link'=>'contacts/create'),
            ]
        ),
        array('title'=>'Organizations', 'link'=>'', 'sub'=>
            [
                array('title'=>'Organizations', 'link'=>'organizations/index'),
                array('title'=>'Create organization', 'link'=>'organizations/create'),
            ]
        ),

        array('title'=>'Tasks', 'link'=>'tasks'),
        array('title'=>'Notifications', 'link'=>''),
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
function response($response, $app, $twig=null)
{

	return isset($app->auth->id) ? $response : Page403($twig, $app);

}
