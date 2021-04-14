<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Indice $index
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Index'), ['action' => 'edit', $index->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Index'), ['action' => 'delete', $index->id], ['confirm' => __('Are you sure you want to delete # {0}?', $index->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Indices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Index'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indices view content">
            <h3><?= h($index->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= h($index->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($index->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Indice') ?></th>
                    <td><?= $this->Number->format($index->indice) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data') ?></th>
                    <td><?= h($index->data) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
