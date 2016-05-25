<?php if ($sf_user->hasCredential(array(  0 =>   array(    0 => 'Root',    1 => 'Administrador',  ),))): ?>
<?php echo $helper->linkToNew(array(  'credentials' =>   array(    0 =>     array(      0 => 'Root',      1 => 'Administrador',    ),  ),  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<?php endif; ?>

<li class="sf_admin_action_formulariofirmas">
  <?php if ($sf_user->hasCredential(array(  0 =>   array(    0 => 'Root',    1 => 'Administrador',  ),))): ?>
<?php echo link_to(__('Formulario de firmas', array(), 'messages'), 'funcionario/formularioFirmas', array()) ?>
<?php endif; ?>

</li>
<li class="sf_admin_action_migrar">
  <?php if ($sf_user->hasCredential(array(  0 =>   array(    0 => 'Root',    1 => 'Administrador',  ),))): ?>
<?php echo link_to(__('Migrar Funcionarios', array(), 'messages'), 'funcionario/migrarFuncionarios', array()) ?>
<?php endif; ?>

</li>
