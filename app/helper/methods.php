<?php



/*
// Return 
// List of side menu
*/
function getMenuList()
{
	$data = array(
		// array('title'=>'Dashboard', 'link'=>''),
		/*array('title'=>'Devices', 'link'=>'/devices'),
		array('title'=>'Orders', 'link'=>'/orders'),
		array('title'=>'Products', 'link'=>'/products'),
		array('title'=>'Stock', 'link'=>'/stock'),
		array('title'=>'Devices management', 'link'=>'/devices_manage'),
		array('title'=>'Devices types', 'link'=>'/device_types'),
		array('title'=>'Settings', 'link'=>'/settings'),*/
		// array('title'=>'Logout', 'link'=>'/logout'),
	);

	return $data;
}

function getProviderMenuList()
{
	$data = array(
		array('title'=>'Dashboard', 'link'=>'/provider_area'),
		array('title'=>'Devices', 'link'=>'/provider_area/devices'),
		array('title'=>'Orders', 'link'=>'/provider_area/orders'),
		array('title'=>'Products', 'link'=>'/provider_area/products'),
		array('title'=>'Stock', 'link'=>'/provider_area/stock'),
		array('title'=>'Devices management', 'link'=>'/provider_area/devices_manage'),
		array('title'=>'Discounts', 'link'=>'/provider_area/discounts'),
		array('title'=>'Settings', 'link'=>'/provider_area/settings'),
		array('title'=>'Logout', 'link'=>'/logout'),
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