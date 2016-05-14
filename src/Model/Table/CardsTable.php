<?php
namespace App\Model\Table;

use App\Model\Entity\Card;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cards Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 * @property \Cake\ORM\Association\BelongsToMany $Users
 */
class CardsTable extends Table
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

        $this->table('cards');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tags', [
            'foreignKey' => 'card_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'cards_tags'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'card_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_cards'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('question');

        $validator
            ->allowEmpty('answer');

        return $validator;
    }
}
