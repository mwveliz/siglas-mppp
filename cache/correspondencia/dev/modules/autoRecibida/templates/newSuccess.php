<?php use_helper('I18N', 'Date') ?>
<?php include_partial('recibida/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Recibida', array(), 'messages') ?></h1>

  <?php include_partial('recibida/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('recibida/form_header', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('recibida/form', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('recibida/form_footer', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
