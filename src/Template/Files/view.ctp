<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Voitures'), ['controller' => 'Voitures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Voiture'), ['controller' => 'Voitures', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td>    <?php
                echo $this->Html->image($file->path . $file->name, [
                    "alt" => $file->name,
                ]);
                ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($file->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($file->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $file->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Voitures') ?></h4>
<?php if (!empty($file->voitures)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Marque') ?></th>
                    <th scope="col"><?= __('Slug') ?></th>
                    <th scope="col"><?= __('Body') ?></th>
                    <th scope="col"><?= __('Published') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
    <?php foreach ($file->voitures as $voitures): ?>
                    <tr>
                        <td><?= h($voitures->id) ?></td>
                        <td><?= h($voitures->user_id) ?></td>
                        <td><?= h($voitures->marque) ?></td>
                        <td><?= h($voitures->slug) ?></td>
                        <td><?= h($voitures->body) ?></td>
                        <td><?= h($voitures->published) ?></td>
                        <td><?= h($voitures->created) ?></td>
                        <td><?= h($voitures->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Voitures', 'action' => 'view', $voitures->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Voitures', 'action' => 'edit', $voitures->id]) ?>
        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Voitures', 'action' => 'delete', $voitures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voitures->id)]) ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
            </table>
<?php endif; ?>
    </div>
</div>
