<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Voitures Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\OffresTable&\Cake\ORM\Association\HasMany $Offres
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Voiture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Voiture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Voiture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Voiture|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Voiture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Voiture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Voiture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Voiture findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VoituresTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('voitures');
        $this->setDisplayField('marque');
        $this->setPrimaryKey('id');
        
        parent::initialize($config);        
        $this->addBehavior('Translate', ['fields' => [ 'body']]);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Offres', [
            'foreignKey' => 'voiture_id',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'voiture_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'voitures_tags',
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'voiture_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'voitures_files',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmptyString('id', null, 'create');

        $validator
                ->scalar('marque')
                ->maxLength('marque', 255)
                ->requirePresence('marque', 'create')
                ->notEmptyString('marque');

        /*        $validator
          ->scalar('slug')
          ->maxLength('slug', 191)
          ->requirePresence('slug', 'create')
          ->notEmptyString('slug')
          ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
         */
        $validator
                ->scalar('body')
                ->allowEmptyString('body');

        $validator
                ->boolean('published')
                ->allowEmptyString('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function beforeSave($event, $entity, $options) {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedMarque = Text::slug($entity->marque);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedMarque, 0, 191);
        }
    }

// The $query argument is a query builder instance.
// The $options array will contain the 'tags' option we passed
// to find('tagged') in our controller action.
    public function findTagged(Query $query, array $options) {
        $columns = [
            'Voitures.id', 'Voitures.user_id', 'Voitures.marque',
            'Voitures.body', 'Voitures.published', 'Voitures.created',
            'Voitures.slug',
        ];

        $query = $query
                ->select($columns)
                ->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find voitures that have no tags.
            $query->leftJoinWith('Tags')
                    ->where(['Tags.marque IS' => null]);
        } else {
            // Find voitures that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                    ->where(['Tags.marque IN' => $options['tags']]);
        }

        return $query->group(['Voitures.id']);
    }

}
