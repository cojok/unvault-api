<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Utility\Security;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

//	public function beforeFilter(Event $event)
//	{
//		parent::beforeFilter($event);
//		// Allow users to register and logout.
//		// You should not add the "login" action to allow list. Doing so would
//		// cause problems with normal functioning of AuthComponent.
//		$this->Auth->config('message', "Woopsie, you are not authorized to access this area.");
//		
//		$this->Auth->allow(['logout', 'add']);
//	}
	
//	/**
//     * Login method
//     *
//     * @return \Cake\Network\Response|null
//     */
//	
//	public function login()
//	{
//		$message = [];
//		if ($this->request->is('post')) {
//			$user = $this->Auth->identify();
//			if ($user) {
//				$this->Auth->setUser($user);
//				
//				$token =  Security::hash($user['id'].$user['email'], 'sha1', true);
//				$this->request->session()->write('Auth.User.token', $token);
//				$this->response->header('Authorization', 'Bearer ' . $token);
//				$message = [
//					"type" => "success",
//					"body" => "Logged In successfully",
//					"token" => 'Bearer ' . $token
//				];
//
//			} else {
//				$message = [
//					"type" => "error",
//					"body" => "Wrong username or password"
//				];
//			}
//			
//			
//			$this->set(compact('message'));
//			$this->set('_serialize', ['message']);
//		}
//	}
	
	/**
     * Logout method
     *
     * @return \Cake\Network\Response|null
     */
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
//        $users = $this->paginate($this->Users);
		
		$id = 1;
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$id = 1;
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		
		$cards = $this->Users->Cards->find('all',['limit' => 200]);

        $this->set(compact('user', 'cards'));
        $this->set('_serialize', ['user', 'cards']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
				
//                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
