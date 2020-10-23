<?php

// src/Model/Table/VoituresTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
// add this use statement right below the namespace declaration to import
// the Validator class
use Cake\Validation\Validator;

class VoituresTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Translate', ['fields' => ['marque', 'body']]);
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Offres', [
            'foreignKey' => 'voiture_id',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'voiture_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'voitures_tags',
        ]);
    }

// Add the following method.

    public function beforeSave($event, $entity, $options) {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedMarque = Text::slug($entity->marque);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedMarque, 0, 191);
        }
    }

// Add the following method.
    public function validationDefault(Validator $validator) {
        $validator
                ->allowEmptyString('marque', false)
                ->minLength('marque', 10)
                ->maxLength('marque', 255)
                ->allowEmptyString('body', false)
                ->minLength('body', 10);

        return $validator;
    }

}
