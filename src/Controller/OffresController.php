<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Offres Controller
 *
 * @property \App\Model\Table\OffresTable $Offres
 *
 * @method \App\Model\Entity\Offre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OffresController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['add']);
    }

    public function isAuthorized($user) {
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Voitures'],
        ];
        $offres = $this->paginate($this->Offres);

        $this->set(compact('offres'));
    }

    /**
     * View method
     *
     * @param string|null $id Offre id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $offre = $this->Offres->get($id, [
            'contain' => ['Voitures'],
        ]);

        $this->set('offre', $offre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    public function add() {
        if ($this->request->session()->read('Voiture.id') == false) {
            $this->Flash->error(__('Offre must be added from an voiture'));
            return $this->redirect(['controller' => 'voitures', 'action' => 'index']);
        } else {
            $offre = $this->Offres->newEntity();
            if ($this->request->is('post')) {
                $offre = $this->Offres->patchEntity($offre, $this->request->getData());
                $offre->voiture_id = $this->request->session()->read('Voiture.id');
                $this->request->session()->delete('Voiture.id');
//            debug($offre); die();
                if ($this->Offres->save($offre)) {
                    $this->Flash->success(__('The offre has been saved.'));
                    $voiture_slug = $this->request->session()->read('Voiture.slug');
                    return $this->redirect(['controller' => 'voitures', 'action' => 'view', $voiture_slug]);
                }
                $this->Flash->error(__('The offre could not be saved. Please, try again.'));
            }
            $voitures = $this->Offres->Voitures->find('list', ['limit' => 200]);
            $this->set(compact('offre', 'voitures'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Offre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $offre = $this->Offres->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $offre = $this->Offres->patchEntity($offre, $this->request->getData());
            if ($this->Offres->save($offre)) {
                $this->Flash->success(__('The offre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The offre could not be saved. Please, try again.'));
        }
        $voitures = $this->Offres->Voitures->find('list', ['limit' => 200]);
        $this->set(compact('offre', 'voitures'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Offre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $offre = $this->Offres->get($id);
        if ($this->Offres->delete($offre)) {
            $this->Flash->success(__('The offre has been deleted.'));
        } else {
            $this->Flash->error(__('The offre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
