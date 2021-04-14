<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Indice[]|\Cake\Collection\CollectionInterface $indices
 */
?>
<div class="indices index content">
    <?= $this->Html->link(__('New Index'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Indices') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tipo') ?></th>
                    <th><?= $this->Paginator->sort('data') ?></th>
                    <th><?= $this->Paginator->sort('indice') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($indices as $index): ?>
                <tr>
                    <td><?= $this->Number->format($index->id) ?></td>
                    <td><?= h($index->tipo) ?></td>
                    <td><?= h($index->data) ?></td>
                    <td><?= $this->Number->format($index->indice) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $index->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $index->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $index->id], ['confirm' => __('Are you sure you want to delete # {0}?', $index->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
