<?php
$lng = isset($app->Settings['lang']) ? $app->Settings['lang'] : 'arabic';
$LANG_ARRAY = include('app/helper/langs/'.$lng.'.php');
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

    $app = $data['app'];

    $data['startdate'] = !empty($app->request->get('start')) ? $app->request->get('start') : date('Y-m-d');
    $data['enddate'] = !empty($app->request->get('end')) ? $app->request->get('end') : date('Y-m-d');
    $data['lang'] = new Langs;
    
    return $twig->render($path, $data);
} 


/*
// Return 
// List of side menu
*/
function getMenuList()
{
	$data = array(
		array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
		array('title'=>__('Devices'),  'icon'=>'fa-desktop', 'link'=>'', 'sub'=>
			[
				array('title'=>__('Calendar'),  'icon'=>'fa-dashboard', 'link'=>'devices/calendar'),
                array('title'=>__('All bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders'),
                array('title'=>__('Active bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=active'),
                array('title'=>__('Completed bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=completed'),
                array('title'=>__('Paid bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=paid'),
                array('title'=>__('Management'),  'icon'=>'fa-dashboard', 'link'=>'devices/manage'),
			]
		),
        array('title'=>__('Products'),  'icon'=>'fa-shopping-cart', 'link'=>'', 'sub'=>
            [
                array('title'=>__('Products list'),  'icon'=>'fa-dashboard', 'link'=>'products/index'),
                array('title'=>__('Stock log'),  'icon'=>'fa-dashboard', 'link'=>'stock/index'),
            ]
        ),
        array('title'=>__('Orders'),  'icon'=>'fa-files-o', 'link'=>'', 'sub'=>
            [
                array('title'=>__('Orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index'),
                array('title'=>__('Paid orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=paid'),
                array('title'=>__('Refund orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=refund'),
            ]
        ),
        array('title'=>__('Payments'),  'icon'=>'fa-money', 'link'=>'payments'),
        // array('title'=>'Invoices',  'icon'=>'feather-user', 'link'=>'invoices'),
        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'', 'sub'=>
            [
                // array('title'=>'Administrators',  'icon'=>'fa-dashboard', 'link'=>'users/admin'),
                array('title'=>__('Managers'),  'icon'=>'fa-dashboard', 'link'=>'users/managers'),
                array('title'=>__('Users'),  'icon'=>'fa-dashboard', 'link'=>'users/agents'),
            ]
        ),


        // array('title'=>'Tasks',  'icon'=>'fa-dashboard', 'link'=>'tasks'),
        // array('title'=>'Notifications',  'icon'=>'fa-bell-o', 'link'=>''),
		array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'settings'),
		array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
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
        'app' => __(),
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


function __($langkey = null)
{
    return Langs::__($langkey);
}

