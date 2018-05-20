<?php
if (!function_exists('cek_semester')) {
	function cek_semester($semester, $angkatan){
			if ($semester %2 != 0){
				$a = (($semester + 10)-1)/10;
				$b = $a - $angkatan;
				$c = ($b*2)-2;
				// echo "Semester : $c";
			  return $c;
			}else{
				$a = (($semester + 10)-2)/10;
				$b = $a - $angkatan;
				$c = ($b * 2)-1;

			 	return $c;
				// dump($b);
				// echo "Semester : $c";
			}
	}
}
?>
