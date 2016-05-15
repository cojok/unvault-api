<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards
 */
class CardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
//        $cards = $this->paginate($this->Cards);
		
		$cards = $this->Cards->find('all',[
			'contain' => [
				'Tags'
			]
		]);

        $this->set(compact('cards'));
        $this->set('_serialize', ['cards']);
    }

    /**
     * View method
     *
     * @param string|null $id Card id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$id = $this->request->params['id'];
        $card = $this->Cards->get($id, [
            'contain' => [
				'Tags'
			]
        ]);

        $this->set('card', $card);
        $this->set('_serialize', ['card']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$message= [];
        $card = $this->Cards->newEntity();
        if ($this->request->is('post')) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
				$message = [
					"type" => "success",
					"body" => "The card was successfully added."
				];
            } else {
				$message = [
					"type" => "error",
					"body" => "There was a problem adding your card."
				];
            }
        }
        $this->set(compact('card', 'message'));
        $this->set('_serialize', ['card', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$id = $this->request->params['id'];
		$message = [];
        $card = $this->Cards->get($id, [
            'contain' => [
				'Tags'
			]
        ]);
		
		echo "<pre>";
		print_r($this->request);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
			print_r($card);

            if ($this->Cards->save($card)) {
				$message = [
					"type" => "success",
					"body" => "The card has been saved."
				];
            } else {
				$message = [
					"type" => "error",
					"body" => "The card could not be saved. Please, try again."
				];
            }
        }
		
		$tags = $this->Cards->Tags->find('list',['limit' => 200]);
        $this->set(compact('card', 'message', 'tags'));
        $this->set('_serialize', ['card', 'message','tags']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$id = $this->request->params['id'];
        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
			$message = [
				"type" => "success",
				"body" => "The card has been deleted."
			];
        } else {
			$message = [
				"type" => "error",
				"body" => "The card could not be deleted. Please, try again."
			];
        }
		$this->set(compact('message'));
		$this->set('_serialize', ['message']);
    }
}
