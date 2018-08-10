<?php  

if (!function_exists('cekNilai')) {
  function cekNilai($n, $type)
  { 
    $nilai = (int)$n; 
    if ($type == 0) {
      // Teori
      if ($nilai >= 16 && $nilai <= 26) {
        return '0'; // kurang
      } else if ($nilai >= 27 && $nilai <= 37) {
        return '1'; // cukup
      } else if ($nilai >= 38 && $nilai <= 48) {
        return '2'; // baik
      } else if ($nilai >= 49 && $nilai <= 60) {
        return '3'; // sangat baik
      }
    } else { 
      if ($nilai >= 20 && $nilai <= 33) {
        return '0';
      } else if ($nilai >= 34 && $nilai <= 47) {
        return '1';
      } else if ($nilai >= 48 && $nilai <= 61) {
        return '2';
      } else if ($nilai >= 62 && $nilai <= 76) {
        return '3';
      }
    }
     
  }
} 
