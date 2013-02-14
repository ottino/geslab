    <script type="text/javascript">
	window.onload = function (){
		var myPDF = new PDFObject({
		  // cambiar ruta donde van a estar los pdf
                  url: "../../../tmp/Comp." 
                          + <?php echo $Protocolo['Protocolo']['id']; ?> + ".pdf" ,		 
		  width: "750px",
		  height: "300px",
                  
                   pdfOpenParams: { view: 'FitH', toolbar: '1' }
                 
		}).embed("muestra_pdf");
	};
    </script>
    
    <?php echo $this->Form->create();?>

    <div class="form-content">
          
            <fieldset>
            <legend>Informacion detallada del Mail</legend>            
            <div class="view_email">         
             <br>
            <?php
               echo '<li>'; 
               echo '<b>Sanatorio :</b>';             
               echo '<i>'.$Protocolo['Sanatorio']['descripcion'].'</i>';
               echo '</li>';
               
               
               echo '<li>'; 
               echo '<b>Correo :</b>';
               echo '<i>'.$Protocolo['Sanatorio']['email'].'</i>';
               echo '</li>';
               
               echo '<li>';
               echo '<b>Paciente :</b>';
               echo '<i>'.$Protocolo['Paciente']['razon_social'].'</i>';
               echo '</li>';
              
               echo '<li>';
               echo '<b>Protocolo :</b>';
               echo '<i>'.$Protocolo['Protocolo']['id'].'</i>';
               echo '</li>';              
               echo '<br>';
               echo '<br>';
               echo '<br>';
               
               echo '<fieldset>';
               echo '<legend>Diagnostico</legend>';
               echo '<div>';
               echo $Protocolo['Protocolo']['diagnostico'];
               echo '</div>';
               echo '</fieldset>';              

            ?>
            </div>
            <div id="muestra_pdf" class="pdf_view"  >
            </div>    
        
     </div>
      
    <?php echo $this->Form->end('Enviar'); ?>


