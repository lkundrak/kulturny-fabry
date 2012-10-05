<div id="venue_map"><img src="" id="venue_map_img"></div>
{foreach from=$_DATA.events item=day name=days key=date_day}
{if $date_day == $_DATA.today}
<h2 class="today">dnes <sup>({$date_day|date_format:"%e.%m."})</sup></h2>
{elseif $date_day == $_DATA.tomorrow}
<h2 class="today">zajtra <sup>({$date_day|date_format:"%e.%m."})</sup></h2>
{else}
<h2>{$date_day|date_format:"%e.%m."}</h2>
{/if}
{foreach from=$day item=event name=event}
<div class="event{if $date_day == $_DATA.today} today{/if}">
    {if $event.flyer}<img class="flyer" src="{$_DATA.base_href}img/event/{$event.flyer}.1.png">{/if}
    <h3>{$event.title}<span class="tag t_green" id="tag_venue_{$event.event_id}" onclick="javascript:venueMap('{$event.venue_id}', '{$event.event_id}', document.getElementById('tag_venue_{$event.event_id}').offsetTop, document.getElementById('tag_venue_{$event.event_id}').offsetLeft)">{$event.venue_title}</span><span class="tag t_blue">{$event.entry}</span><span class="tag t_red">{$event.when|date_format:"%H:%M"}</span></h3>
    <p>{$event.description}{if $event.url} &nbsp;&nbsp;&nbsp;<a href="{$event.url}">viac informácii &raquo;</a>{/if}</p>
    <div class="break"></div>
</div>
{/foreach}

{/foreach}
{paginate maxpage=15 page=$_DATA.count.page pages=$_DATA.count.pages}
