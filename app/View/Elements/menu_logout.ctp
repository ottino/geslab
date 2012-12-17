<?php  $usuario = $this->Session->read('usuario'); ?>

<?php if(isset($usuario['Usuario'])): ?>
<div class='menu logout'>
<ul>
    <li><strong>Usuario:</strong>
        <?php echo $usuario['Usuario']['usuario']; ?>
    </li>
    <li><strong>Nombre:</strong>
        <?php echo $usuario['Usuario']['nombre']; ?>
    </li>
    <li><strong>Perfil:</strong>
        <?php echo $usuario['Perfil']['nombre']; ?>
    </li>   
    <li>
        <?php  echo $this->Html->link(BTN_INI, array('controller'=>'inicio') );  ?>    
    </li>            
    <li>
        <?php  echo $this->Html->link(BTN_EXIT, array('controller'=>'usuarios',
                'action'=>'salir'));  ?>    
    </li>            
</ul>
</div>
<?php endif; ?>