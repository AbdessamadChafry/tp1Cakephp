<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offre $offre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Offre'), ['action' => 'edit', $offre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Offre'), ['action' => 'delete', $offre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Offres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offre'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Voitures'), ['controller' => 'Voitures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Voiture'), ['controller' => 'Voitures', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="offres view large-9 medium-8 columns content">
    <h3><?= h($offre->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Voiture') ?></th>
            <td><?= $offre->has('voiture') ? $this->Html->link($offre->voiture->marque, ['controller' => 'Voitures', 'action' => 'view', $offre->voiture->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($offre->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($offre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($offre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($offre->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Offre') ?></h4>
        <?= $this->Text->autoParagraph(h($offre->offre)); ?>
    </div>
</div>
