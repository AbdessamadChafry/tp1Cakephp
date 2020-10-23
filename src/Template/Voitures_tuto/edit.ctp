<!-- File: src/Template/Voitures/edit.ctp -->

<h1>Edit Voiture</h1>
<?php
echo $this->Form->create($voiture);
echo $this->Form->control('user_id', ['type' => 'hidden']);
echo $this->Form->control('marque');
echo $this->Form->control('body', ['rows' => '3']);
echo $this->Form->control('tags._ids', ['options' => $tags, 'multiple' => 'checkbox']);
echo $this->Form->button(__('Save Voiture'));
echo $this->Form->end();
?>
