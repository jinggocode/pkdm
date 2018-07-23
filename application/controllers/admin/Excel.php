<?php


// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet 

class Excel extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array(''));
	}

	public function index()
	{ 
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( 'coba.xlsx' );
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
		$data['rows'] = $rows;
 
		$this->render('excel', $data);
	}

	public function tambah()
	{
		dump('ini tambah');
	}

}