<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offres Model
 *
 * @property \App\Model\Table\VoituresTable&\Cake\ORM\Association\BelongsTo $Voitures
 *
 * @method \App\Model\Entity\Offre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Offre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Offre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Offre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Offre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Offre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OffresTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('offres');
        $this->setDisplayField('name');

        $this->addBehavior('Timestamp');
        
        parent::initialize($config);
        $this->addBehavior('Translate', ['fields' => ['name', 'offre']]);

        $this->belongsTo('Voitures', [
            'foreignKey' => 'voiture_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('offre')
            ->requirePresence('offre', 'create')
            ->notEmptyString('offre');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['voiture_id'], 'Voitures'));

        return $rules;
    }
}
