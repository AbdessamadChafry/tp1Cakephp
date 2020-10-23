<!-- File: src/Template/Voitures/add.ctp -->

<h1>Add Voiture</h1>
<?php
echo $this->Form->create($voiture);
// Hard code the user for now.
//echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
echo $this->Form->control('marque');
echo $this->Form->control('body', ['rows' => '3']);
echo $this->Form->control('tags._ids', ['options' => $tags]); //, 'multiple' => 'checkbox']);
echo $this->Form->button(__('Save Voiture'));
echo $this->Form->end();
?>
