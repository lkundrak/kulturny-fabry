<?php
function smarty_function_paginate($params, &$smarty) {
    require_once $smarty->_get_plugin_filepath('function','ch_querystring');

    $url = $_SERVER['SCRIPT_URI']."?";

    if($params['pages'] > 1) {
        echo '<div class="paging">';
        if($params['page'] > 1) {
            printf('<a href="%s%s">%s</a>&nbsp;', $url, smarty_function_ch_querystring(array("name" => "page", "value" => $params['page']-1), $smarty), _("&laquo; Predchádzajúca"));
        }

        for($i = 1; $i < $params['pages'] + 1; $i++) {
            if($i < $params['page']+$params['maxpage'] && $i > $params['page']-$params['maxpage']) {
                if($i == $params['page']) {
                    echo $i."&nbsp;";
                } else {
                    printf('<a href="%s%s">%s</a>&nbsp;', $url, smarty_function_ch_querystring(array("name" => "page", "value" => $i), $smarty), $i);
                }
            }
        }

        if($params['pages'] > $params['page']) {
            printf('<a href="%s%s">%s</a>', $url, smarty_function_ch_querystring(array("name" => "page", "value" => $params['page']+1), $smarty), _("Ďaľšia &raquo;"));
        }

        echo "</div>";
    } else {
        if($params['empty']) {
            echo $params['empty'];
        }
    }
}
?>
