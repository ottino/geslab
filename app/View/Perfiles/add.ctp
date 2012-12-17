<div class="form">
    <?php  echo $this->Form->create(); ?>

    <div class="form-content">
        <fieldset>
            <legend>Nuevo Perfil</legend>            
            <?php    
                    echo $this->Form->input('nombre');
            
                    $opciones = array();
                    foreach($modulos as $m){
                        $opciones[$m['Modulo']['grupo']][] = $m['Modulo'];
                    }
            ?>

            <h2>Permisos</h2>
            <div id="tabstrip">
                <ul>
                    <?php 
                    $c = 0;

                    foreach(array_keys($opciones) as $key){            
                        $active = "";
                        if($c == 0) $active = "class='k-state-active'";            
                        echo "<li $active>".strtoupper($key)."</li>";            
                        $c++;
                    }
                    ?>        
                </ul>

                <?php                 
                    foreach($opciones as $grupo=>$modulos){
                        echo "<div><div><span>&nbsp;</span>";
                        foreach ($modulos as $m) {                    
                            $id = $m['id'];
                            $nombre = $m['nombre'];

                            echo "<div class='checkbox'>
                                    <input type='checkbox' name='data[Modulo][Modulo][]' value='$id' id='ModuloModulo$id'>
                                    <label for='ModuloModulo$id'>$nombre</label>
                                    </div>";                    
                        }
                        echo "</div><span class='tab'>&nbsp;</span></div>";
                    }
                ?>
            </div>
                
        </fieldset>
    </div>
    <?php  echo $this->Form->end('Guardar'); ?>
</div>


<style scoped>            
        .tab {
                display: inline-block;
                margin: 20px 0 20px 10px;
        }
</style>

<script>
    $(document).ready(function() {
        $("#tabstrip").kendoTabStrip({
                        animation:	{
                                open: {
                                        effects: "fadeIn"
                                }
                        }

                });
    });
</script>
