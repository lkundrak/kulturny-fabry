<?php /* Smarty version 2.6.26, created on 2010-01-26 12:51:46
         compiled from content_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'content_list.tpl', 4, false),array('function', 'paginate', 'content_list.tpl', 20, false),)), $this); ?>
<div id="venue_map"><img src="" id="venue_map_img"></div>
<?php $_from = $this->_tpl_vars['_DATA']['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['days'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['days']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['date_day'] => $this->_tpl_vars['day']):
        $this->_foreach['days']['iteration']++;
?>
<?php if ($this->_tpl_vars['date_day'] == $this->_tpl_vars['_DATA']['today']): ?>
<h2 class="today">dnes <sup>(<?php echo ((is_array($_tmp=$this->_tpl_vars['date_day'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.") : smarty_modifier_date_format($_tmp, "%e.%m.")); ?>
)</sup></h2>
<?php elseif ($this->_tpl_vars['date_day'] == $this->_tpl_vars['_DATA']['tomorrow']): ?>
<h2 class="today">zajtra <sup>(<?php echo ((is_array($_tmp=$this->_tpl_vars['date_day'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.") : smarty_modifier_date_format($_tmp, "%e.%m.")); ?>
)</sup></h2>
<?php else: ?>
<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['date_day'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.") : smarty_modifier_date_format($_tmp, "%e.%m.")); ?>
</h2>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['event'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['event']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['event']):
        $this->_foreach['event']['iteration']++;
?>
<div class="event<?php if ($this->_tpl_vars['date_day'] == $this->_tpl_vars['_DATA']['today']): ?> today<?php endif; ?>">
    <?php if ($this->_tpl_vars['event']['flyer']): ?><img class="flyer" src="<?php echo $this->_tpl_vars['_DATA']['base_href']; ?>
img/event/<?php echo $this->_tpl_vars['event']['flyer']; ?>
.1.png"><?php endif; ?>
    <h3><?php echo $this->_tpl_vars['event']['title']; ?>
<span class="tag t_green" id="tag_venue_<?php echo $this->_tpl_vars['event']['event_id']; ?>
" onclick="javascript:venueMap('<?php echo $this->_tpl_vars['event']['venue_id']; ?>
', '<?php echo $this->_tpl_vars['event']['event_id']; ?>
', document.getElementById('tag_venue_<?php echo $this->_tpl_vars['event']['event_id']; ?>
').offsetTop, document.getElementById('tag_venue_<?php echo $this->_tpl_vars['event']['event_id']; ?>
').offsetLeft)"><?php echo $this->_tpl_vars['event']['venue_title']; ?>
</span><span class="tag t_blue"><?php echo $this->_tpl_vars['event']['entry']; ?>
</span><span class="tag t_red"><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['when'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</span></h3>
    <p><?php echo $this->_tpl_vars['event']['description']; ?>
<?php if ($this->_tpl_vars['event']['url']): ?> &nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['event']['url']; ?>
">viac informácii &raquo;</a><?php endif; ?></p>
    <div class="break"></div>
</div>
<?php endforeach; endif; unset($_from); ?>

<?php endforeach; endif; unset($_from); ?>
<?php echo smarty_function_paginate(array('maxpage' => 15,'page' => $this->_tpl_vars['_DATA']['count']['page'],'pages' => $this->_tpl_vars['_DATA']['count']['pages']), $this);?>
