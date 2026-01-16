<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('biografias/(:segment)', 'Biografias::page/$1');
$routes->get('campanias/(:segment)', 'Campanias::page/$1');
$routes->get('noticias/(:segment)', 'Noticias::page/$1');
$routes->get('frecuencias/(:segment)', 'Frecuencias::page/$1');
$routes->get('envianos-tu-pedido', 'Contactenos::pedidos');
$routes->get('contacto', 'Contactenos::contacto');
$routes->get('cuentanos-tu-testimonio', 'Contactenos::testimonio');

$routes->setAutoRoute(true);
