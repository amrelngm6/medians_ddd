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
		array('title'=>'Dashboard', 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
		array('title'=>'Devices',  'icon'=>'fa-desktop', 'link'=>'', 'sub'=>
			[
				array('title'=>'Calendar',  'icon'=>'fa-dashboard', 'link'=>'devices/calendar'),
                array('title'=>'All bookings',  'icon'=>'fa-dashboard', 'link'=>'devices/orders'),
                array('title'=>'Active bookings',  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=active'),
                array('title'=>'Completed bookings',  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=completed'),
                array('title'=>'Paid bookings',  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=paid'),
                array('title'=>'Management',  'icon'=>'fa-dashboard', 'link'=>'devices/manage'),
			]
		),
        array('title'=>'Produts',  'icon'=>'fa-shopping-cart', 'link'=>'', 'sub'=>
            [
                array('title'=>'Products list',  'icon'=>'fa-dashboard', 'link'=>'products/index'),
                array('title'=>'Stock log',  'icon'=>'fa-dashboard', 'link'=>'stock/index'),
            ]
        ),
        array('title'=>'Orders',  'icon'=>'fa-files-o', 'link'=>'', 'sub'=>
            [
                array('title'=>'Orders',  'icon'=>'fa-dashboard', 'link'=>'orders/index'),
                array('title'=>'Paid orders',  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=paid'),
                array('title'=>'Refund orders',  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=refund'),
            ]
        ),
        array('title'=>'Payments',  'icon'=>'fa-money', 'link'=>'payments'),
        // array('title'=>'Invoices',  'icon'=>'feather-user', 'link'=>'invoices'),
        array('title'=>'Users',  'icon'=>'fa-users', 'link'=>'', 'sub'=>
            [
                // array('title'=>'Administrators',  'icon'=>'fa-dashboard', 'link'=>'users/admin'),
                array('title'=>'Managers',  'icon'=>'fa-dashboard', 'link'=>'users/managers'),
                // array('title'=>'Agents',  'icon'=>'fa-dashboard', 'link'=>'users/agents'),
            ]
        ),


        // array('title'=>'Tasks',  'icon'=>'fa-dashboard', 'link'=>'tasks'),
        // array('title'=>'Notifications',  'icon'=>'fa-bell-o', 'link'=>''),
		array('title'=>'Settings',  'icon'=>'fa-cogs', 'link'=>'settings'),
		array('title'=>'Logout',  'icon'=>'fa-sign-out', 'link'=>'logout'),
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
