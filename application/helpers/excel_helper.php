<?php  

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
if (!function_exists('getArrayDataFromExcel')) {
  function getArrayDataFromExcel($file_name)
  {  
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( 'excel/file/'.$file_name );
		$worksheet = $spreadsheet->getActiveSheet();
		$rows = [];
		foreach ($worksheet->getRowIterator() AS $row) {
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
			$cells = [];
			foreach ($cellIterator as $cell) {
				$cells[] = $cell->getValue();
			}
			$rows[] = $cells;
		}
		 
		unset($rows[0]); 
		return $rows; 
  }
} 
