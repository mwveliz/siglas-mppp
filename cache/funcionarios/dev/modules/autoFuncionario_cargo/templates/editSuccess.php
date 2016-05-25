<?php use_helper('I18N', 'Date') ?>
<?php include_partial('funcionario_cargo/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Desincorporación del Funcionario en el cargo', array(), 'messages') ?></h1>

  <?php include_partial('funcionario_cargo/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('funcionario_cargo/form_header', array('funcionarios_funcionario_cargo' => $funcionarios_funcionario_cargo, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('funcionario_cargo/form', array('funcionarios_funcionario_cargo' => $funcionarios_funcionario_cargo, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('funcionario_cargo/form_footer', array('funcionarios_funcionario_cargo' => $funcionarios_funcionario_cargo, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
