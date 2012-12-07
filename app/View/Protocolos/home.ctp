<div class="users form">
	<?php echo $this->Form->create('Paciente',array('action'=>'search'));?>
	<?php
		echo $this->Form->input('paciente',array('type'=>'text','id'=>'paciente','label'=>'Search'));
	?>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>


