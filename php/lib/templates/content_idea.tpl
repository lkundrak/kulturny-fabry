<div id="canvas-border"><div id="canvas"></div></div>

<script language="javascript">
{foreach from=$_DATA.ideas item=idea}
drawIdea({$idea.idea_id}, 0, '{$idea.idea}');
{/foreach}
</script>
