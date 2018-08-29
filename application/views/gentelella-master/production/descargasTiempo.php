<?php
$objPHPExcel = new PHPExcel();

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1','Empresa')
						->setCellValue('B1','Hora_Registro')
						->setCellValue('C1','Turno')
						->setCellValue('D1','No_Orden')
						->setCellValue('E1','No_Parte')
						->setCellValue('F1','No_molde')
						->setCellValue('G1','Cavidades')
						->setCellValue('H1','Máquina')
						->setCellValue('I1','Materia_Prima')
						->setCellValue('J1','Lote_Materia_Prima')
						->setCellValue('K1','Num_Operador')
						->setCellValue('L1','Num_Lider')
						->setCellValue('M1','Horas_Trabajadas')
						->setCellValue('N1','Objetivo')
						->setCellValue('O1','Piezas Buenas')
						->setCellValue('P1','Eficiencia')
						->setCellValue('Q1','Tiempo_muerto')
						->setCellValue('R1','Tiempo_muerto_total')
						->setCellValue('S1','Departamento')
						->setCellValue('T1','Motivo')
						->setCellValue('U1','Tiempo_muerto_individual');
			$objPHPExcel->getActiveSheet()->fromArray($reporte,null,'A2');
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="ReporteTiempo'.date('Y_m_d').'".xls"');
				header('Cache-Control: max-age=0');
				$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
				$objWriter->save('php://output');
				exit;
?>
