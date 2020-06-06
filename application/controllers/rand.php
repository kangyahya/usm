<?php
function get_token($panjang)
{

$token=array(range(0,9));
$karakter=array();
foreach($token as $key=>$val){
	foreach($val as $k=>$v){
		$karakter[] = $v;

	}
}
$token=null;
for($i=1; $i<$panjang; $i++){

	$token.=$karakter[rand($i,count($karakter)-1)];
} return $token;
}

//panjang 15 karakter
echo get_token(15);



?>
