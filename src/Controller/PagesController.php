<?php
/**
 *  Pages Controller
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\View\Exception\MissingTemplateException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;


class PagesController extends AppController
{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();
	}


	public function initialize()
	{          

		parent::initialize();       
	}

	/**
     *  Return Forbiden 403
     * 
     */
	public function forbiden()
	{        
		throw new ForbiddenException("Access not allowed");       
	}

	/**
     *  Return Unauthorized 401
     * 
     */
	public function unauthorized()
	{   
		throw new UnauthorizedException("You are not logged in");       
	}
	
	/**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
	public function display()
	{
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = null;
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		$this->set(compact('page', 'subpage'));
		try {
			$this->render(implode('/', $path));
		} catch (MissingTemplateException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}