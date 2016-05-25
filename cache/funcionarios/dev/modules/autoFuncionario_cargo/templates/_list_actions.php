<?php if ($sf_user->hasCredential(array(  0 =>   array(    0 => 'Root',    1 => 'Administrador',  ),))): ?>
<?php echo $helper->linkToNew(array(  'credentials' =>   array(    0 =>     array(      0 => 'Root',      1 => 'Administrador',    ),  ),  'label' => 'Asignar cargo',  'params' =>   array(  ),  'class_suffix' => 'new',)) ?>
<?php endif; ?>

