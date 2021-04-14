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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $index->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $index->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Indices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indices form content">
            <?= $this->Form->create($index) ?>
            <fieldset>
                <legend><?= __('Edit Index') ?></legend>
                <?php
                echo $this->Form->control('tipo', ['options' => \App\Dominio\Indice\TipoIndice::listIndices()]);
                    echo $this->Form->control('data');
                    echo $this->Form->control('indice');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
