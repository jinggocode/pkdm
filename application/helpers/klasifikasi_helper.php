<?php  

if (!function_exists('cekNilai')) {
  function cekNilai($n, $type)
  { 
    $nilai = (int)$n; 
    if ($type == 0) {
      if ($nilai >= 14 && $nilai <= 24) {
        return '0'; // kurang
      } else if ($nilai >= 25 && $nilai <= 35) {
        return '1'; // cukup
      } else if ($nilai >= 36 && $nilai <= 46) {
        return '2'; // baik
      } else if ($nilai >= 47 && $nilai <= 56) {
        return '3'; // sangat baik
      }
    } else { 
      if ($nilai >= 18 && $nilai <= 31) {
        return '0';
      } else if ($nilai >= 32 && $nilai <= 45) {
        return '1';
      } else if ($nilai >= 46 && $nilai <= 59) {
        return '2';
      } else if ($nilai >= 60 && $nilai <= 72) {
        return '3';
      }
    }
     
  }
} 
