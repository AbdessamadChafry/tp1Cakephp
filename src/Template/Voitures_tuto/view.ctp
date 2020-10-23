<!-- File: src/Template/Voitures/view.ctp -->

<h1><?= h($voiture->marque) ?></h1>
<p><?= h($voiture->body) ?></p>
<p><small>Created: <?= $voiture->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $voiture->slug]) ?></p>
<p><?php
    $this->request->session()->write('Voiture.id', $voiture->id);
    $this->request->session()->write('Voiture.slug', $voiture->slug);
    echo $this->Html->link(__('New Offre'), ['controller' => 'Offres', 'action' => 'add']);
    ?></p>
<div class="related">
    <h4><?= __('Related Offres') ?></h4>
    <?php if (!empty($voiture->offres)): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($voiture->offres as $offre): ?>
                    <tr>
                        <td><?= $this->Number->format($offre->id) ?></td>
                        <td><?= h($offre->name) ?></td>
                        <td><?= h($offre->created) ?></td>
                        <td><?= h($offre->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Offres', 'action' => 'view', $offre->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Offres', 'action' => 'edit', $offre->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Offres', 'action' => 'delete', $offre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offre->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
