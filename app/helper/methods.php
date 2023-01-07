<?php

// TWIG template engine
use Twig\Environment;
$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('./app'), 
    [
        //'cache' => '/app/cache',
        'debug' => true,
    ]
);


$twig->addFilter(new \Twig\TwigFilter('html_entity_decode', 'html_entity_decode'));



/** 
 * Render function
 * @param String twig file path
 * @param [] List of data
 */
function render($path, $data)
{
    global $twig;

    return $twig->render($path, $data);
} 


/*
// Return 
// List of side menu
*/
function getMenuList()
{
	$data = array(
		array('title'=>'Dashboard', 'link'=>'dashboard'),
		array('title'=>'Devices', 'link'=>'', 'sub'=>
			[
				array('title'=>'Calendar', 'link'=>'devices/calendar'),
                array('title'=>'Management', 'link'=>'devices'),
			]
		),
        array('title'=>'Produts', 'link'=>'', 'sub'=>
            [
                array('title'=>'Products list', 'link'=>'products/index'),
                array('title'=>'Stock log', 'link'=>'stock/index'),
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

        array('title'=>'Invoices', 'link'=>'invoices'),
        array('title'=>'Payments', 'link'=>'payments'),
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
