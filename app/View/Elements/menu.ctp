
<?php  $menu = $this->Session->read('menu'); ?>

<?php if(!empty($menu)): ?>
<ul id="kmenu">
    <?php foreach ($menu as $grupos): ?>

       <?php foreach ($grupos as $items): ;?>        
           <?php if(isset($items['en_menu']) && ($items['en_menu'])): ?>
           <li>
               <?php 
                if( !empty($items['accion'])){
                    echo $this->Html->link($items['nombre'], '/'.$items['accion']);
                }else{
                    if(isset($items['nombre']))
                        echo $items['nombre'];
                    else
                        continue;
                }
               ?>

                <?php if( isset($items['subgrupo']) ): ?>                 
                    <ul>
                 
                        <?php foreach ($items['subgrupo'] as $i): ?>
                            <li>
                            <?php
                                if(isset($i['en_menu']) && ($i['en_menu'])){
                                    if( !empty($i['accion'])){
                                        echo $this->Html->link($i['nombre'], '/'.$i['accion']);
                                    }else{
                                        echo $i['nombre'];
                                    }
                                }
                            ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                <?php endif; ?>

            </li>
            <?php endif; ?>        
       <?php endforeach; ?>
    
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $("#kmenu").kendoMenu({
            animation: { open: { effects: false } }
        });
    });
</script>