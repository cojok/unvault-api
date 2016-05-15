<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersCards Controller
 *
 * @property \App\Model\Table\UsersCardsTable $UsersCards
 */
class UsersCardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $usersCards = $this->paginate($this->UsersCards);

        $this->set(compact('usersCards'));
        $this->set('_serialize', ['usersCards']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Card id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$id = $this->request->params['id'];
        $usersCard = $this->UsersCards->get($id, [
            'contain' => []
        ]);

		print_r($usersCard);
        $this->set('usersCard', $usersCard);
        $this->set('_serialize', ['usersCard']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersCard = $this->UsersCards->newEntity();
		$message = [];
        if ($this->request->is('post')) {
            $usersCard = $this->UsersCards->patchEntity($usersCard, $this->request->data);
            if ($this->UsersCards->save($usersCard)) {
				$message = [
					"type" => "success",
					"body" => "The users card has been saved."
				];
            } else {
				$message = [
					"type" => "error",
					"body" => "The users card could not be saved. Please, try again."
				];
            }
        }
		$users = $this->UsersCards->Users->find('list', ['limit' => '200']);
		$cards = $this->UsersCards->Cards->find('list', ['limit' => '200']);
		$this->set(compact('usersCard', 'users', 'cards','message'));
		$this->set('_serialize', ['usersCard', 'users', 'cards', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Card id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersCard = $this->UsersCards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCard = $this->UsersCards->patchEntity($usersCard, $this->request->data);
            if ($this->UsersCards->save($usersCard)) {
                $this->Flash->success(__('The users card has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users card could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usersCard'));
        $this->set('_serialize', ['usersCard']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Card id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$message = [];
        $this->request->allowMethod(['post', 'delete']);
		
		$id = $this->request->params['id'];
		
        $usersCard = $this->UsersCards->get($id);
		
        if ($this->UsersCards->delete($usersCard)) {
			$message = [
				'type' => 'success',
				'body' => 'The users card has been deleted.'
			];
        } else {
			$message = [
				"type" => "error",
				"body" => "The users card could not be deleted. Please, try again."
			];
        }
		$this->set(compact('message'));
		$this->set('_serialize', ['message']);

    }
}
