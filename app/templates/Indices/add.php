<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Index $index
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Indices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indices form content">
            <?= $this->Form->create($index) ?>
            <fieldset>
                <legend><?= __('Add Index') ?></legend>
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
