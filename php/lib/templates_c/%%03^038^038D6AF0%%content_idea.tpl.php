<?php /* Smarty version 2.6.26, created on 2009-12-29 12:39:00
         compiled from content_idea.tpl */ ?>
<div id="canvas-border"><div id="canvas"></div></div>

<script language="javascript">
<?php $_from = $this->_tpl_vars['_DATA']['ideas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idea']):
?>
drawIdea(<?php echo $this->_tpl_vars['idea']['idea_id']; ?>
, 0, '<?php echo $this->_tpl_vars['idea']['idea']; ?>
');
<?php endforeach; endif; unset($_from); ?>
</script>