<h1>
    Voitures tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
<?php foreach ($voitures as $voiture): ?>
    <voiture>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $voiture->marque,
            ['controller' => 'Voitures', 'action' => 'view', $voiture->slug]
        ) ?></h4>
        <span><?= h($voiture->created) ?></span>
    </voiture>
<?php endforeach; ?>
</section>
