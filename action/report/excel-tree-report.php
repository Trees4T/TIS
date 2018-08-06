<?php
ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');
session_start();
include '../../koneksi/koneksi.php';

$awal 	=$_POST['awal'];
$akhir 	=$_POST['akhir'];
$status =$_POST['status'];
if ($_SESSION['level']=='fin') {
	$kode 	=$_POST['member'];
}else{
	$kode 	=$_SESSION['kode'];
}
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
							 ->setTitle("T4T Trees Planted Report")
							 ->setSubject("T4T Trees Planted Report")
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

// Add some data
$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A1', 'Ship Report Date')
            ->setCellValue('B1', 'Shipment')
            ->setCellValue('C1', 'BL Date')
            ->setCellValue('D1', 'BL')
            ->setCellValue('E1', 'Farmer')
            ->setCellValue('F1', 'Village')
            // ->setCellValue('F1', 'Target Area')
            // ->setCellValue('G1', 'M. Unit')
            ->setCellValue('G1', 'Trees QTY')
            ->setCellValue('H1', 'Retailer Code')


            ->getStyle('A1:H1')
		    ->getAlignment()
		    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)

            ;

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);


$no=1;
$i=1;
$tree_planted=$conn->query("select s.wkt_shipment,s.no_shipment,s.bl_tgl,s.bl,h.petani,h.desa,h.jml_phn,s.buyer,s.id_comp,s.no,h.bl from t4t_shipment s join t4t_htc h on s.bl=h.bl AND s.id_comp='$kode' and s.wkt_shipment between '$awal' and '$akhir' order by h.no desc");

while ($data=$tree_planted->fetch())

	{
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
				// $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
				// $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
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

       //data loop
       $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($A,date("Y-m-d", strtotime($data[0])))
							->setCellValue($B,$data[1])
							->setCellValue($C,$data[2])
							->setCellValue($D,$data[3])
							->setCellValue($E,$data[4])
							->setCellValue($F,$data[5])
							->setCellValue($G,$data[6])
							->setCellValue($H,$data[7]);

			$jml_loop[]=$i;

		}

		$loop=count($jml_loop);
		$jml_loop2=$loop+2;


		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$jml_loop2, ''.$_SESSION['tot_tree'].'')
					->getStyle('G'.$jml_loop2)
				    ->getAlignment()
				    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);






// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Trees Planted Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="T4T Trees Planted Report '.$awal.' to '.$akhir.'.xls"');
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
