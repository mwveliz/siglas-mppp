<?php use_helper('I18N', 'Date') ?>
<?php include_partial('enviada/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nueva correspondencia o solicitud', array(), 'messages') ?></h1>

  <?php include_partial('enviada/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('enviada/form_header', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('enviada/form', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('enviada/form_footer', array('correspondencia_correspondencia' => $correspondencia_correspondencia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
