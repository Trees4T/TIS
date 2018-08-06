<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
session_start();
include '../../koneksi/koneksi.php';
function __autoload($class){
 include_once('../function/class.'.$class.".php");
}

$office = new office();

$kd_part		= $_POST['kd_part'];
$date_awal 	= $_POST['date_awal'];
$date_akhir = $_POST['date_akhir'];
$alamat     = $_POST['alamat'];
$part       = $_POST['part'];


/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../../assets/excel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("T4T Information System")
							 // ->setLastModifiedBy("Rio Jerico Widyatama")
							 ->setLastModifiedBy("T4T Information System")
							 ->setTitle("T4T Contribution Report")
							 ->setSubject("T4T Contribution Report")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("T4T Report");
// Border
$BStyle = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$objPHPExcel->getActiveSheet()
    ->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);
// Add some data
//HEADER
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Contribution Report')
            ->setCellValue('B2', $part)
            ->setCellValue('D2', $alamat)
            ->setCellValue('G4', $date_awal.' to '.$date_akhir)
            ->getStyle('A2:H4')
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ;
$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setUnderline(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(12);
$objPHPExcel->getActiveSheet()
    ->getStyle('D2:E3')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:C1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C3');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:E3');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G4:H4');
$objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setUnderline(true);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G4:H4');
$objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setUnderline(true);

//COLUMN TITLE
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A6', '')
            ->setCellValue('B6', 'Order No.')
            ->setCellValue('C6', 'Shipment Date')
            ->setCellValue('D6', 'Shipment No.')
            ->setCellValue('E6', 'BL No.')
            ->setCellValue('F6', 'Approval Date')
            ->setCellValue('G6', 'Fee (USD $)')
            ->setCellValue('H6', 'Payment Date')

            ->getStyle('A6:H6')
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
     ;

$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFont()->setBold(true);

//DATA
$no=6;
$i=6;
$mkt_report = $office->mkt_rep_contrib($kd_part,$date_awal,$date_akhir);
foreach ($mkt_report as $mkt_reports)
	{
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4,36);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16,36);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15,64);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);

				$i=$i+1;
			        $A='A'.$i;
							$B='B'.$i;
							$C='C'.$i;
							$D='D'.$i;
							$E='E'.$i;
							$F='F'.$i;
							$G='G'.$i;
							$H='H'.$i;

        date_default_timezone_set('Asia/Jakarta');

       //data loop$mkt_reports->no_order
       $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($A,"")
							->setCellValue($B,$mkt_reports->no_order)
							->setCellValue($C,$mkt_reports->wkt_shipment)
							->setCellValue($D,$mkt_reports->no_shipment)
							->setCellValue($E,$mkt_reports->bl)
							->setCellValue($F,"")
							->setCellValue($G,$mkt_reports->fee)
							->setCellValue($H,$mkt_reports->tgl_paid);

			$jml_loop[]=$i;

		}

		$loop=count($jml_loop);
		$jml_loop2=$loop+7;


		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$jml_loop2, ''.$_SESSION['tot_contrib'].'')
					->getStyle('G'.$jml_loop2)
				  ->getAlignment()
				  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Trees Contribution Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="T4T Contribution Report - '.$kd_part.' - '.$date_awal.' to '.$date_akhir.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
