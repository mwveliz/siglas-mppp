<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_foto">
  <?php echo __('Foto', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cargo">
  <?php echo __('', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_ci">
  <?php if ('ci' == $sort[0]): ?>
    <?php echo link_to(__('Cédula', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=ci&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Cédula', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=ci&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_primer_nombre">
  <?php if ('primer_nombre' == $sort[0]): ?>
    <?php echo link_to(__('1º Nombre', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=primer_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('1º Nombre', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=primer_nombre&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_segundo_nombre">
  <?php if ('segundo_nombre' == $sort[0]): ?>
    <?php echo link_to(__('2º Nombre', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=segundo_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('2º Nombre', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=segundo_nombre&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_primer_apellido">
  <?php if ('primer_apellido' == $sort[0]): ?>
    <?php echo link_to(__('1º Apellido', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=primer_apellido&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('1º Apellido', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=primer_apellido&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_segundo_apellido">
  <?php if ('segundo_apellido' == $sort[0]): ?>
    <?php echo link_to(__('2º Apellido', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=segundo_apellido&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('2º Apellido', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=segundo_apellido&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sexo">
  <?php if ('sexo' == $sort[0]): ?>
    <?php echo link_to(__('Sexo', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=sexo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Sexo', array(), 'messages'), '@funcionarios_funcionario', array('query_string' => 'sort=sexo&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_contacto">
  <?php echo __('Contacto', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_usuario">
  <?php echo __('Usuario', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>