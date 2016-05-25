<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_codigo_unidad">
  <?php if ('codigo_unidad' == $sort[0]): ?>
    <?php echo link_to(__('Codigo unidad', array(), 'messages'), '@organigrama_unidad', array('query_string' => 'sort=codigo_unidad&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Codigo unidad', array(), 'messages'), '@organigrama_unidad', array('query_string' => 'sort=codigo_unidad&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_list_identificacion">
  <?php echo __('Identificación', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_list_detalles">
  <?php echo __('Detalles', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_list_direccion">
  <?php echo __('Dirección', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>