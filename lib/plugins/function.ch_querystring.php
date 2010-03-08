<?php

function smarty_function_ch_querystring($params, &$smarty) {
//	if(isset($params['name']) && isset($params['value'])) {
		$changed = false;
		$qa = "";

		if(strchr($params['name'], "|")) {
			$_params = explode("|", $params['name']);
			$_values = explode("|", $params['value']);
		} else {
			$_params[] = $params['name'];
			$_values[] = $params['value'];
		}
		
		foreach($_GET as $name => $value) {
			if($name == "param") {
				foreach($value as $p => $v) {
					foreach($v as $_p => $_v) {
						$qa .= "&param[".$p."][".$_p."]=".$_v;
					}
				}
			} elseif($name == "utm_source" || $name == "utm_medium" || $name == "utm_campaign") {
				continue;
			} else {
				foreach($_params as $i => $j) {
					if($name == $j) {
						if(!empty($_values[$i])) {
							$qa .= "&".$j."=".$_values[$i];
						}
						$changed = true;
						continue(2);
					}
				}
						
				if(is_array($value)) {
					$qa .= rozloz_pole($name, $value);
				} else {
					//$qa .= sprintf("&%s=%s", $name, $value);
					$qa .= "&".$name."=".$value;
				}	
			}
		}
		
		if(!$changed && !empty($_params)) {
			foreach($_params as $pi => $p1) {
				if(!empty($p1)) {
					//$qa .= sprintf("&%s=%s", $params['name'], $params['value']);
					$qa .= "&".$p1."=".$_values[$pi];
				}
			}
		}
		
		return $qa;
//	} else {
//		return false;
//	}
}

function rozloz_pole($name, $value) {
	foreach($value as $n => $v) {
		if(is_array($v)) {
			$r .= rozloz_pole($n, $v);
		} else {
			//$r .= sprintf("&%s[%s]=%s", $name, $n, $v);
			$r .= "&".$name."[".$n."]=".$v;
		}
	}
	return $r;
}

?>