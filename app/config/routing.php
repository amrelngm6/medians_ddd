<?php 

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('contact', new Route('/contact', array(
    '_controller' => 'Medians:Application:Administrators:Admin:index',
)));

return $collection;