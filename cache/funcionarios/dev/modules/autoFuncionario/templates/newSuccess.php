<?php use_helper('I18N', 'Date') ?>
<?php include_partial('funcionario/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nuevo Funcionario o Personal', array(), 'messages') ?></h1>

  <?php include_partial('funcionario/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('funcionario/form_header', array('funcionarios_funcionario' => $funcionarios_funcionario, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('funcionario/form', array('funcionarios_funcionario' => $funcionarios_funcionario, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('funcionario/form_footer', array('funcionarios_funcionario' => $funcionarios_funcionario, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
