<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
	
	// roter extions for getting only json output
	$routes->extensions(['json']);
	
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
	
	
	// Home route
	$routes->connect('/home', ['controller' => 'Users', 'action' => 'view']);
	
	//add a card
	$routes->connect('/add-card', ['controller' => 'Cards', 'action' => 'add']);
	
	//edit a card
	$routes->connect('/:id/update-card', ['controller' => 'Cards', 'action' => 'edit']);
	
	//delete card
	$routes->connect('/:id/delete-card', ['controller' => 'Cards', 'action' => 'delete']);
	
	//get all cards
	$routes->connect('/cards', ['controller' => 'Cards', 'action' => 'index']);
	
	//user add card 
	$routes->connect('/user-add-card', ['controller' => 'UsersCards', 'action' => 'add']);
	
	//remove user card
	$routes->connect('/:id/delete-user-card', ['controller' => 'UsersCards', 'action' => 'delete']);
	
	//user cards
	$routes->connect('/:id/card', ['controller' => 'Cards', 'action' => 'view']);
	
	//logged in user data
	$routes->connect('/user', ['controller' => 'Users', 'action' => 'index']);
	
	//get tags
	$routes->connect('tags', ['controller' => 'Tags', 'action' => 'index']);
	
	$routes->connect(  '/forbiden', ['controller' => 'Pages', 'action'=>'forbiden']); 
	$routes->connect(  '/unauthorized', ['controller' => 'Pages', 'action'=>'unauthorized']);
	
	
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

//// LOGIN Routes
//Router::scope('/login',  ['controller' => 'Login'], function($routes) {    
//	$routes->connect(  '/', ['action'=>'index',  '_ext'=>'json','[method]'=>'POST']); 
//	$routes->connect(  '/', ['action'=>'logout', '_ext'=>'json','[method]'=>'GET']);         
//});  



/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
