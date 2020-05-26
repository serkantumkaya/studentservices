<?php

function som($var1, $var2) 
{
	return $var1 + $var2;
}

function minimum($var1, $var2)
{
	if($var1 < $var2)
		return $var1;
	
	return $var2;
}

function product($var1, $var2)
{
	return $var1 * $var2;
}

function modulo($getal, $deler)
{
	if($deler == 0)
		return $getal;
	
	return $getal % $deler;
}

function inhoud($hoogte, $breedte, $lengte)
{
	if($hoogte < 0 OR $breedte < 0 OR $lengte < 0)
		return 0;
	
	return $hoogte * $breedte * $lengte;
}

function checkIfLarger($var1, $var2)
{
	return $var1 > $var2;
}


?>
