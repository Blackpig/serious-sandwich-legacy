<?php
function vd($var)
{
	echo "<pre>";
	my_var_dump( $var );
	echo "</pre>";
}

/** my_var_dump() is a substitute for the var_dump PHP fonction.
 * It uses a marking algorithm to know which references it has allready
 * visited. It creates unique ids so that you may understand where thoses
 * allready visited references were displayed.
 *
 * @param $var the var to dump
 * @param $unsetAll true if you wish to unset all the labeled ids
 * @param $links true if you wish to display links between referees and
 *        references
 */

function my_var_dump($var, $unsetAll = true, $links = true)
{
	_my_var_dump_aux($var, $links);
	if ($unsetAll) _unset_all_var_dump($var);
}

function _generateId($isArray)
{
	static $idArrays = 0;
	static $idObjects = 0;
	
	if ($isArray)
		return 'ARR_'.$idArrays++;
	else return 'OBJ_'.$idObjects++;
}

function _my_var_dump_aux($var, $links = true)
{
//	print '<pre>';
	if ((is_array($var) && isset($var["VAR_DUMP_NAME"]))
		|| (is_object($var) && isset($var->___var_dumped)))
	{
		$id = (is_array($var) ? $var["VAR_DUMP_NAME"]
				: $var->___var_dumped);
		if ($links)
			print('<b><a href="#'.$id.'">Ref '.$id.'</a></b>');
		else
			print('<b>Ref '.$id.'</b>');
	}
	else
	{
		if (is_array($var))
		{
			$id = _generateId(true);
			$size = sizeof($var);
			print '<b><a name="'.$id.'">'.$id.'</a></b> array[<b>'.$size.'</b>]';
			print '<table border=1 cellspacing=0 cellpadding=3>';
// LL		print ' ) {';
			
			$var["VAR_DUMP_NAME"] = $id;
			
			reset($var);
			$index = 1;
			foreach ($var as $key => $value)
			{
				if (is_int($key) || $key != "VAR_DUMP_NAME")
				{
					print '<tr bgcolor=#D0D0D0><td>';
// LL				print('<dir>');
					print('"'.$key.'" </td>'.(is_array($var[$key])?'<td colspan="2">':'<td>').' ');
// LL				print('"'.$key.'" => ');
					
					if ($var[$key] == null)
						print('NULL');
					else
						_my_var_dump_aux($var[$key], $links);
						
					if ($index < $size) print('');
// LL				if ($index < $size) print(',');
					
					print '</td></tr>';
// LL				print('</dir>');
				}
				$index++;
			}
			print( '</table>' );
// LL		print('}');
		}
		else if (is_object($var))
		{
			$id = _generateId(false);
			$var->___var_dumped = $id;
			print('<b><a name="'.$id.'">'.$id.'</a></b> object('.get_class($var).') {');
			print '<table border=5 cellspacing=0 cellpadding=3>';
			foreach ($var as $key => $value)
			{
				if ($key != "VAR_DUMP_NAME")
				{
					print '<tr><td>';
// LL				print('<dir>');

					print('-> '.$key.' </td><td> ');	
// LL				print('->'.$key.' = ');	

					if (!isset($var->$key))
						print('NULL');
					else
						_my_var_dump_aux($var->$key, $links);

					print '</td></tr>';
// LL				print('</dir>');
				}
			}
			print( '</table>' );
//			print('}');
		}
		else
		{
			ob_start();
			var_dump($var);
			$str = ob_get_contents();
			ob_end_clean(); 
			$str = ereg_replace( "(string\([^\)]+\) )(.*)", "\\1</td><td>\\2", $str );
			$str = ereg_replace( "(bool)\(([^\)]+)\)", "\\1</td><td>\\2", $str );
			$str = ereg_replace( "(int)\(([^\)]+)\)", "\\1</td><td>\\2", $str );
			print $str;
		}
	}
// LL	print '</pre>';
}

function _unset_all_var_dump($var)
{
	if (is_array($var) && isset($var["VAR_DUMP_NAME"]))
	{
		unset($var["VAR_DUMP_NAME"]);
		reset($var);
		foreach ($var as $key => $value)
		{
			if ((is_int($key) || $key != "VAR_DUMP_NAME")
			&& $var[$key] != null)
				_unset_all_var_dump($var[$key]);
		}
	}
	else if (is_object($var) && isset($var->___var_dumped))
	{
		unset($var->___var_dumped);
		foreach ($var as $key => $value)
		{
			if ($key != "VAR_DUMP_NAME" && isset($var->$key))
				_unset_all_var_dump($var->$key);
		}
	}
}

?>
