<?php  
App::import('Vendor','PHPExcel',array('file' => 'Excel/PHPExcel.php')); 
App::import('Vendor','PHPExcelWriter',array('file' => 'Excel/PHPExcel/Writer/Excel5.php')); 
App::import('Vendor','PHPExcel_Writer_PDF',array('file' => 'Excel/PHPExcel/Writer/PDF.php'));
App::import('Vendor','PHPExcel_Cell_AdvancedValueBinder',array('file' => 'Excel/PHPExcel/Cell/AdvancedValueBinder.php'));


class ExcelHelper extends AppHelper { 
     
    var $xls; 
    var $sheet; 
    var $data; 
    var $blacklist = array(); 
    var $model;
    var $type = 'XLS'; // XLS o PDF
    var $pref = '';
    var $date = array(); 
    var $money = array(); 
    
    function excelHelper() { 
        $this->xls = new PHPExcel(); 
        $this->sheet = $this->xls->getActiveSheet(); 
        $this->sheet->getDefaultStyle()->getFont()->setName('Verdana'); 
    } 
                  
    function generate(&$data, $title = 'Reporte', $model = null, $blacklist = null, $type = 'XLS', $pref = '', $date = null, $money = null ) {
         if(is_array($blacklist))
             $this->blacklist = $blacklist;
         
         if(is_array($date))
             $this->date = $date;
         
         if(is_array($money))
             $this->money = $money;
         
         $this->data =& $data;
         $this->model = $model;
         $this->type = $type;
         $this->pref = $pref;
         
         $this->_title($title);         
         $this->_headers(); 
         $this->_rows(); 
         $this->_output($title);
         return true; 
    } 
     
    function _title($title) {      
        $this->sheet->setCellValue('A2', $title); 
        $this->sheet->getStyle('A2')->getFont()->setSize(12);
        $this->sheet->getStyle('A2')->getFont()->setBold(true);
        $this->sheet->mergeCells("A2:E2");
        //$this->sheet->getRowDimension('2')->setRowHeight(23);
    } 

    function _headers() { 
        $i=0;
        if(!is_array($this->model))
                    $this->model = array($this->model);

        
        foreach ($this->model as $model) {
            foreach ($this->data[0][$model] as $field => $value) {
                if($this->pref != '')
                   $field = str_replace($this->pref, '', $field);
                
                if (!in_array($field,$this->blacklist)) {
                    $columnName = Inflector::humanize($field);
                    $this->sheet->setCellValueByColumnAndRow($i++, 4, $columnName);                    
                }
            }
        }
        
        $this->sheet->getStyle('A4')->getFont()->setBold(true); 
        $this->sheet->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID); 
        $this->sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('bfbfbf'); 
        $this->sheet->duplicateStyle( $this->sheet->getStyle('A4'), 'B4:'.$this->sheet->getHighestColumn().'4'); 
        for ($j=1; $j<$i; $j++) { 
            $this->sheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($j))->setAutoSize(true); 
        } 
    } 
         
    function _rows() { 
                
        $i=5; 
        foreach ($this->data as $row) {
            
            $j=0;
            if(!is_array($this->model))
                    $this->model = array($this->model);
            
            foreach ($this->model as $model) {
                foreach ($row[$model] as $field => $value) {
                    if(!in_array($field,$this->blacklist)) {
                        $this->sheet->setCellValueByColumnAndRow($j,$i, $value);
                        
                        if (in_array($field, $this->date)){
                            PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() ); 
                            $coordinate = $this->sheet->getCellByColumnAndRow($j,$i)->getCoordinate();
                            $this->sheet->getStyle("$coordinate")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY );
                        }
                        
                        if (in_array($field, $this->money)){
                            PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() ); 
                            $coordinate = $this->sheet->getCellByColumnAndRow($j,$i)->getCoordinate();
                            $this->sheet->getStyle("$coordinate")->getNumberFormat()->setFormatCode('$ #,##0.00');
                        }
                        
                        $j++;
                    }
                }
            }
             
            $i++; 
        }
        
    } 
             
    function _output($title) {
        switch ($this->type) {
            case 'XLS':
                $header_type = "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                $filename = $title . '.xls';

                $objWriter = new PHPExcel_Writer_Excel5($this->xls);
                $objWriter->setTempDir(TMP);
            break;

            case 'PDF':
                $header_type = "Content-Type: application/pdf";
                $filename = $title . '.pdf';
                
                $dompdf_base_dir = APP . 'Vendor' . DS . 'dompdf';

                PHPExcel_Settings::setPdfRenderer(PHPExcel_Settings::PDF_RENDERER_DOMPDF, $dompdf_base_dir);
                PHPExcel_Settings::setPdfRendererName(PHPExcel_Settings::PDF_RENDERER_DOMPDF);
                
                $objWriter = new PHPExcel_Writer_PDF($this->xls);                
                $objWriter->setTempDir(TMP);
            break;
        }

        header($header_type);
        
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        //Genero salida
        $objWriter->save('php://output'); 
    }
} 
?>