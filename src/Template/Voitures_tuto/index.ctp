<!-- File: src/Template/Voitures/index.ctp  (edit links added) -->

<h1>Voitures</h1>
<p><?= $this->Html->link("Add Voiture", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Marque</th>
        <th>Created</th>
        <th>By</th>
        <th>Action</th>
    </tr>

    <!-- Here's where we iterate through our $voitures query object, printing out voiture info -->

<?php foreach ($voitures as $voiture): ?>
    <tr>
        <td>
            <?= $this->Html->link($voiture->marque, ['action' => 'view', $voiture->slug]) ?>
        </td>
        <td>
            <?= $voiture->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link($voiture->user->email, ['controller' => 'users', 'action' => 'view', $voiture->user_id])?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $voiture->slug]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $voiture->slug],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>
