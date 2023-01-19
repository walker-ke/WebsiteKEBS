<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	$ifconditions_test_option = function($rule){
		$first = $this->Parser->parse($rule['first']);
		$second = $this->Parser->parse($rule['second']);
		$sign = $rule['sign'];
		
		if($sign == '=='){
			return ($first == $second);
		}elseif($sign == '!='){
			return ($first != $second);
		}elseif($sign == '>'){
			return ($first > $second);
		}elseif($sign == '<'){
			return ($first < $second);
		}elseif($sign == '>='){
			return ($first >= $second);
		}elseif($sign == '<='){
			return ($first <= $second);
		}elseif($sign == 'regex'){
			return preg_match($second, $first);
		}elseif($sign == '!regex'){
			return !preg_match($second, $first);
		}elseif($sign == 'in'){
			$second = array_filter(array_map('trim', explode("\n", $second)), 'strlen');
			return in_array($first, $second);
		}elseif($sign == '!in'){
			$second = array_filter(array_map('trim', explode("\n", $second)), 'strlen');
			return !in_array($first, $second);
		}elseif($sign == 'empty'){
			return empty($first);
		}elseif($sign == '!empty'){
			return !empty($first);
		}elseif($sign == 'null'){
			return is_null($first);
		}elseif($sign == '!null'){
			return !is_null($first);
		}elseif($sign == 'numeric'){
			return is_numeric($first);
		}elseif($sign == 'bool'){
			return is_bool($first);
		}elseif($sign == 'integer'){
			return is_integer($first);
		}elseif($sign == 'string'){
			return is_string($first);
		}else{
			return false;
		}
	};
	
	$_result = null;
	
	
	if(!empty($function['events']) AND is_array($function['events'])){
		foreach($function['events'] as $event){
			$event_result = true;
			$result = false;
			if(!empty($event['name']) AND !empty($event['groups'])){
				foreach($event['groups'] as $rule){
					$event_result = ($event_result AND $ifconditions_test_option($rule));
				}
				
				if($event_result){
					$_result = $event['name'];
					$this->Parser->fevents[$function['name']][$event['name']] = true;
					break;
				}
			}
		}
	}
	
	$this->set($function['name'], $_result);