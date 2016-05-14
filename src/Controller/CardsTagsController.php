<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CardsTags Controller
 *
 * @property \App\Model\Table\CardsTagsTable $CardsTags
 */
class CardsTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $cardsTags = $this->paginate($this->CardsTags);

        $this->set(compact('cardsTags'));
        $this->set('_serialize', ['cardsTags']);
    }

    /**
     * View method
     *
     * @param string|null $id Cards Tag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cardsTag = $this->CardsTags->get($id, [
            'contain' => []
        ]);

        $this->set('cardsTag', $cardsTag);
        $this->set('_serialize', ['cardsTag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cardsTag = $this->CardsTags->newEntity();
        if ($this->request->is('post')) {
            $cardsTag = $this->CardsTags->patchEntity($cardsTag, $this->request->data);
            if ($this->CardsTags->save($cardsTag)) {
                $this->Flash->success(__('The cards tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cards tag could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cardsTag'));
        $this->set('_serialize', ['cardsTag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cards Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cardsTag = $this->CardsTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cardsTag = $this->CardsTags->patchEntity($cardsTag, $this->request->data);
            if ($this->CardsTags->save($cardsTag)) {
                $this->Flash->success(__('The cards tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cards tag could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cardsTag'));
        $this->set('_serialize', ['cardsTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cards Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cardsTag = $this->CardsTags->get($id);
        if ($this->CardsTags->delete($cardsTag)) {
            $this->Flash->success(__('The cards tag has been deleted.'));
        } else {
            $this->Flash->error(__('The cards tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
