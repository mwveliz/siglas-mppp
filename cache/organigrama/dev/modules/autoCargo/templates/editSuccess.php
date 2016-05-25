<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cargo/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar Cargo %%codigo_nomina%%', array('%%codigo_nomina%%' => $organigrama_cargo->getCodigoNomina()), 'messages') ?></h1>

  <?php include_partial('cargo/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('cargo/form_header', array('organigrama_cargo' => $organigrama_cargo, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('cargo/form', array('organigrama_cargo' => $organigrama_cargo, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('cargo/form_footer', array('organigrama_cargo' => $organigrama_cargo, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
