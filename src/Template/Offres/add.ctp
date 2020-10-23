<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offre $offre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Offres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Voitures'), ['controller' => 'Voitures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Voiture'), ['controller' => 'Voitures', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="offres form large-9 medium-8 columns content">
    <?= $this->Form->create($offre) ?>
    <fieldset>
        <legend><?= __('Add Offre') ?></legend>
        <?php
//            echo $this->Form->control('voiture_id', ['options' => $voitures]);
            echo $this->Form->control('name');
            echo $this->Form->control('offre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
