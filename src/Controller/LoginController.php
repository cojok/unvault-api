<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Login Controller
 *
 * @property \App\Model\Table\LoginTable $Login
 */
class LoginController extends AppController
{

	/**
     *  Initialize Controller
     */

	public function initialize()
	{          
		$this->loadModel('Users');
		parent::initialize();       
	}


	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'logout']);
	}

	/**
     * Index Login method  API URL  /api/login method: POST
     * @return json response
     */
	public function index()
	{   
		try {                                    
			if(!isset($this->request->data['email'])){
				throw new UnauthorizedException("Please enter your email address as your username");                
			}
			if(!isset($this->request->data['password'])){
				throw new UnauthorizedException("Please enter your password");                
			}
			$email  = $this->request->data['email'];
			$password  = $this->request->data['password'];

			// Check for user credentials 
			$user = $this->Users->find('login', ['email'=>$email]);
			//check hash pass with entered pass
			$passwordCheck = (new DefaultPasswordHasher)->check($password, $user->password);
			
			if(!$passwordCheck) {
				throw new UnauthorizedException("Invalid login");     
			}

			// if everything is OK set Auth session with user data
			$this->Auth->setUser($user->toArray());

			// Generate user Auth token
			$token =  Security::hash(date('l jS \of F Y h:i:s A').$user->email, 'sha1', true);
			// Add user token into Auth session
			$this->request->session()->write('Auth.User.token', $token);

			// return Auth token
			$this->response->header('Authorization', 'Bearer ' . $token);
			
//			print_r($this->request->session()->read());



		} catch (UnauthorizedException $e) {            
			throw new UnauthorizedException($e->getMessage(),401);   
		}           
		$this->set('user', $this->request->session()->read());        
		$this->set('_serialize', ['user']);
	}
	/**
     * Logout user
     * API URL  /api/login method: DELETE
     * @return json response
     */
	public function logout()
	{        
		$this->Auth->logout();
		$this->set('message', 'You were logged out');
		$this->set('_serialize', ['message']);
	}
}