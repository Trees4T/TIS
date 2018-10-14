<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
session_start();
include '../../koneksi/koneksi.php';
function __autoload($class){
 include_once('../function/class.'.$class.".php");
}

$office = new office();

$id_part = $_POST['id_part'];
$awal 	 = $_POST['awal'];
$akhir 	 = $_POST['akhir'];

$detail_part = $office->data_member($id_part);
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
							 ->setTitle("T4T Wincheck Log Report")
							 ->setSubject("T4T Wincheck Log Report")
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
            ->setCellValue('B1', 'Wincheck Log Report')
            ->setCellValue('B2', $detail_part->name)
            ->setCellValue('D2', $detail_part->address)
            ->setCellValue('E4', date("d F Y", strtotime($awal)).' to '.date("d F Y", strtotime($akhir)))
            ->getStyle('A2:F4')
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ;
$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setUnderline(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(12);
$objPHPExcel->getActiveSheet()
    ->getStyle('D2:E3')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:C1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C3');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:E3');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E4:F4');
$objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setUnderline(true);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E4:F4');
$objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setUnderline(true);

//COLUMN TITLE
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A6', '')
            ->setCellValue('B6', 'Checking Date.')
            ->setCellValue('C6', 'WIN')
            ->setCellValue('D6', 'Order No.')
            ->setCellValue('E6', 'Shipment No.')
            ->setCellValue('F6', 'BL No.')

            ->getStyle('A6:F6')
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
     ;

$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->getFont()->setBold(true);

//DATA
// $no=6;
$i=6;
$data = $office->mkt_rep_wincheck($id_part,$awal,$akhir);
foreach ($data as $datas)
	{
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4,36);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14,55);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12,73);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16,82);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16,82);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20,02);

				$i=$i+1;
			  //       $A='A'.$i;
							$B='B'.$i;
							$C='C'.$i;
							$D='D'.$i;
							$E='E'.$i;
							$F='F'.$i;

       //data loop$mkt_reports->no_order
       $objPHPExcel->setActiveSheetIndex(0)
							// ->setCellValue("A7","")
							->setCellValue($B,date("Y-m-d",strtotime($datas->search_date)) )
							->setCellValue($C,$datas->wins)
							->setCellValue($D,$datas->no_order)
							->setCellValue($E,$datas->no_shipment)
							->setCellValue($F,$datas->bl);

			// $jml_loop[]=$i;
		}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('T4T Wincheck Log Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="T4T Wincheck Log Report.xls"');
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
