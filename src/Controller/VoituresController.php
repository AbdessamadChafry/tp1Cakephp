<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Voitures Controller
 *
 * @property \App\Model\Table\VoituresTable $Voitures
 *
 * @method \App\Model\Entity\Voiture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class   VoituresController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['tags']);
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the voiture belongs to the current user.
        $voiture = $this->Voitures->findBySlug($slug)->first();

        return $voiture->user_id === $user['id'];
    }

    public function tags(...$tags) {
        // Use the VoituresTable to find tagged voitures.
        $voitures = $this->Voitures->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'voitures' => $voitures,
            'tags' => $tags
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Tags', 'Files'],
        ];
        $voitures = $this->paginate($this->Voitures);

        $this->set(compact('voitures'));
    }

    /**
     * View method
     *
     * @param string|null $id Voiture id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null) {
        $voiture = $this->Voitures->find()
                ->where(['Voitures.slug' => $slug])
                ->contain(['Offres', 'Tags', 'Files'])
                ->firstOrFail();

        $this->set('voiture', $voiture);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $voiture = $this->Voitures->newEntity();
        if ($this->request->is('post')) {
            $voiture = $this->Voitures->patchEntity($voiture, $this->request->getData());
            $voiture->user_id = $this->Auth->user('id');
//            debug($voiture); die();
            if ($this->Voitures->save($voiture)) {
                $this->Flash->success(__('The voiture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voiture could not be saved. Please, try again.'));
        }
        $files = $this->Voitures->Files->find('list', ['limit' => 200]);
        $tags = $this->Voitures->Tags->find('list', ['limit' => 200]);
        $this->set(compact('voiture', 'tags', 'files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Voiture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null) {
        $voiture = $this->Voitures->findBySlug($slug)
                ->contain('Tags', 'Files')
                ->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $voiture = $this->Voitures->patchEntity($voiture, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Voitures->save($voiture)) {
                $this->Flash->success(__('The voiture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voiture could not be saved. Please, try again.'));
        }
        $files = $this->Voitures->Files->find('list', ['limit' => 200]);
        $tags = $this->Voitures->Tags->find('list', ['limit' => 200]);
        $this->set(compact('voiture', 'tags', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Voiture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null) {
        $this->request->allowMethod(['post', 'delete']);
        $voiture = $this->Voitures->findBySlug($slug)->firstOrFail();
        if ($this->Voitures->delete($voiture)) {
            $this->Flash->success(__('The voiture has been deleted.'));
        } else {
            $this->Flash->error(__('The voiture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
