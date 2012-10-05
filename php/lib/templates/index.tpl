<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Michal Fabry <michal@fabry.sk>"/>
	<meta name="robots" content="index, follow" />
    <meta name="verify-v1" content="{$_DATA._google_meta_verify}" />
 	<title>Kultúrna súpiska</title>
	<base href="{$_DATA.base_href}" />
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
    	{include file=content_$content.tpl}
    </div>
    <div id="right">
        {foreach from=$_DATA.venues item=venue}
            <a href="{$venue.url}{*venue/{$venue.venue_id}-{$venue.title|make_seo_url}*}"{if $_DATA.venue_id == $venue.venue_id} class="active"{/if}>
                <img src="img/venue/{$venue.venue_id}.png">
            </a>
        {/foreach}
    </div>
    <div class="break"></div>
	<div id="footer">
        Informácie su bez záruky. Update podujatí prebieha automaticky vždy v noci parsovaním webových stránok jednotlivých podnikov. <br>
        Chcete pridať ďaľší podnik? Napíšte na <a href="mailto:michal@fabry.sk">michal@fabry.sk</a> a uvidím či sa s tým dá niečo robiť.
	</div>
</div>
{literal}
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1281324-2");
pageTracker._trackPageview();
} catch(err) {}</script>
{/literal} 
</body>
</html>
