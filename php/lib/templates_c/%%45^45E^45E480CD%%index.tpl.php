<?php /* Smarty version 2.6.26, created on 2010-01-26 12:26:38
         compiled from index.tpl */ ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Michal Fabry <michal@fabry.sk>"/>
	<meta name="robots" content="index, follow" />
    <meta name="verify-v1" content="<?php echo $this->_tpl_vars['_DATA']['_google_meta_verify']; ?>
" />
 	<title>Kultúrna súpiska</title>
	<base href="<?php echo $this->_tpl_vars['_DATA']['base_href']; ?>
" />
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon"> 
	<link rel="stylesheet" href="css/style.css" type="text/css" />
    <script language="javascript" type="text/javascript" src="js/global.js"></script>
</head>
<body>

<div id="body">
	<div id="header">
        <img src="img/facepalm.png" style="float: right;">
        <div id="quote"><span class="quote2">je tire des pipes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;comme une princesse</span></div>
		<h1>Kultúrna súpiska</h1>

        <div id="menu">
            <div id="searchbox"><form action="hladaj/" method="get"><input type="text" name="s"><input type="submit" value="hľadaj"></form></div>

            <a href="#" class="active">Brno</a>
            <a href="#">Praha</a>
            <a href="#">Ostrava</a>
            <a href="#">Plzeň</a>
            <a href="#">Olomouc</a>
        </div>
        <div class="break"></div>
	</div>
	
    <div id="left">
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_".($this->_tpl_vars['content']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <div id="right">
        <?php $_from = $this->_tpl_vars['_DATA']['venues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['venue']):
?>
            <a href="<?php echo $this->_tpl_vars['venue']['url']; ?>
"<?php if ($this->_tpl_vars['_DATA']['venue_id'] == $this->_tpl_vars['venue']['venue_id']): ?> class="active"<?php endif; ?>>
                <img src="img/venue/<?php echo $this->_tpl_vars['venue']['venue_id']; ?>
.png">
            </a>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="break"></div>
	<div id="footer">
        Informácie su bez záruky. Update podujatí prebieha automaticky vždy v noci parsovaním webových stránok jednotlivých podnikov. <br>
        Chcete pridať ďaľší podnik? Napíšte na <a href="mailto:michal@fabry.sk">michal@fabry.sk</a> a uvidím či sa s tým dá niečo robiť.
	</div>
</div>
<?php echo '
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1281324-2");
pageTracker._trackPageview();
} catch(err) {}</script>
'; ?>
 
</body>
</html>