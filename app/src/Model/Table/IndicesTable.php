<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Dominio\Indice\IndiceProvider;
use App\Dominio\Indice\TipoIndice;
use App\Model\Entity\Indice;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Indices Model
 *
 * @method \App\Model\Entity\Indice newEmptyEntity()
 * @method \App\Model\Entity\Indice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Indice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Indice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Indice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Indice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Indice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Indice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class IndicesTable extends Table implements IndiceProvider
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setEntityClass(Indice::class);
        $this->setTable('indices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmptyDate('data');

        $validator
            ->decimal('indice')
            ->requirePresence('indice', 'create')
            ->notEmptyString('indice');

        return $validator;
    }

    public function getIndice(TipoIndice $tipo, \DateTimeImmutable $data): string
    {
        /** @var \App\Model\Entity\Indice|null $indice */
        $indice = $this->find()
            ->where([
                'data' => $data->format('Y-m-01'),
                'tipo' => $tipo->getTipo(),
            ])
            ->first();

        if (empty($indice)) {
            $msg = 'Índice ' . $tipo->getTipo() . ' do mês ' . $data->format('m/Y') . ' não encontrado!';
            throw new \RuntimeException($msg);
        }

        return (string)$indice->indice;
    }
}
