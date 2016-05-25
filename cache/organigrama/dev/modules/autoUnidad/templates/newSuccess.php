<?php use_helper('I18N', 'Date') ?>
<?php include_partial('unidad/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nueva Unidad', array(), 'messages') ?></h1>

  <?php include_partial('unidad/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('unidad/form_header', array('organigrama_unidad' => $organigrama_unidad, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('unidad/form', array('organigrama_unidad' => $organigrama_unidad, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('unidad/form_footer', array('organigrama_unidad' => $organigrama_unidad, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
