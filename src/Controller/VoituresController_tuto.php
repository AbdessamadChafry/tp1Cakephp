<?php

// src/Controller/VoituresController.php

namespace App\Controller;

class VoituresController extends AppController {

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

    public function index() {
        $this->loadComponent('Paginator');
        $voitures = $this->Paginator->paginate($this->Voitures->find(
                        'all', [
                    'contain' => ['Users', 'Tags'],
        ]));
        $this->set(compact('voitures'));
    }

    // Add to existing src/Controller/VoituresController.php file

    public function view($slug = null) {
        $voiture = $this->Voitures->find()
                ->where(['Voitures.slug' => $slug])
                ->contain(['Offres', 'Tags'])
                ->firstOrFail();
//        $voiture = $this->Voitures->findBySlug($slug)->firstOrFail();
//        debug($voiture);
//       die();
        $this->set(compact('voiture'));
    }

    public function add() {
        $voiture = $this->Voitures->newEntity();
        if ($this->request->is('post')) {
            $voiture = $this->Voitures->patchEntity($voiture, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $voiture->user_id = $this->Auth->user('id');
//            debug($voiture); die();
            if ($this->Voitures->save($voiture)) {
                $this->Flash->success(__('Your voiture has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your voiture.'));
        }
        // Get a list of tags.
        $tags = $this->Voitures->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);
        $this->set('voiture', $voiture);
    }

    // in src/Controller/VoituresController.php
// Add the following method.

    public function edit($slug) {
        $voiture = $this->Voitures->findBySlug($slug)
                ->contain('Tags')
                ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Voitures->patchEntity($voiture, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
//            debug($voiture); die();
            if ($this->Voitures->save($voiture)) {
                $this->Flash->success(__('Your voiture has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your voiture.'));
        }
        // Get a list of tags.
        $tags = $this->Voitures->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);
        $this->set('voiture', $voiture);
    }

    public function delete($slug) {
        $this->request->allowMethod(['post', 'delete']);

        $voiture = $this->Voitures->findBySlug($slug)->firstOrFail();
        if ($this->Voitures->delete($voiture)) {
            $this->Flash->success(__('The {0} voiture has been deleted.', $voiture->marque));
            return $this->redirect(['action' => 'index']);
        }
    }

}
