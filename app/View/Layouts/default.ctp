<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = CONST_TITULO;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

                echo $this->Html->css('kendoui/kendo.common.min');
                echo $this->Html->css('kendoui/kendo.default.min');
                
                echo $this->Html->css('jquery-ui-1.9.2.custom.min');
                echo $this->Html->css('jquery.asmselect.css');
                
                
                
                echo $this->Html->script('jquery-1.8.3');
                echo $this->Html->script('jquery-ui-1.9.2.custom.min');
                echo $this->Html->script('jquery.asmselect.js');
                echo $this->Html->script('pdfobject.js');

                
                echo $this->Html->script('kendoui/kendo.web.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
                    <div class="title">
			<h1>
                        <?php echo $this->Html->link($cakeDescription, '/'); ?>                            
                        </h1>
                    </div>
                    <div class="menu-logout">
                        <?php echo $this->element('menu_logout'); ?>
                    </div>
                    <div class="clear"></div>
		</div>
            
                <div id="menu">                                        
                    <?php echo $this->element('menu'); ?>
                </div>
            
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright 2012
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
