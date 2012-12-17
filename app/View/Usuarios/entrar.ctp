<div class="login">
<?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo 'Iniciar Sesión'; ?></legend>
    <?php
        echo $this->Form->input('usuario');
        echo $this->Form->input('clave' , array( 'type' => 'password') );        
    ?>
    </fieldset>
<?php echo $this->Form->end('Entrar'); ?>
</div>