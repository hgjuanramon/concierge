<?php

if (!defined('BASEPATH'))
    exit('No direct access alloweb');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF {

    /**
     * Construct
     *
     * @param string $orientation P portrait(vertical) o L (Landscape Horizontal)
     * @param string $unit pt: point , mm: millimeter (default), cm: centimeter, in: inch
     * @param string $format A4 , LETTER , LEGAL
     * @param bool $unicode texto en unicode
     * @param string $encoding codificacion de caracteres
     * @param bool $diskcache Usar el cache del disco
     * @param type $pdfa 
     * @link http://www.tcpdf.org/doc/classTCPDF.html#a134232ae3ad1ec186ed45046f94b7755
     */
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'Letter', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    public function Header() {
        
        //parent::Header();
    }
    /**
     * Genera el footer para las paginas del PDF
     * Si ponemos una coordenada negativa entoces sera desde el footer hacia arriba
     */
    public function Footer() {   
        $this->SetY(-15);// La posicion de la celda sera de 15 mm desde el bottom
        $this->SetFont('helvetica', 'I', 8); // Fuente
        $this->SetTextColor(179,215,247);// Color del texto
        $this->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(252,153,153)));
        $this->Cell(0, 0, 'Pagina. [' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages() . ']', 'T', 0, 'C'); // dibujamos Numero de pagina
    }
    
    public function get_page_size(){ return $this->pagedim[$this->page]['wk']; }

    /**
     * http://www.onemoretake.com/2009/03/09/tcpdf-variable-height-table-rows-with-multicell/
     */
    public function get_max_height(){
        foreach($data as $row) {
            $maxnocells = 0;
            $cellcount = 0;
            //write text first
            $startX = $pdf->GetX();
            $startY = $pdf->GetY();
            //draw cells and record maximum cellcount
            //cell height is 6 and width is 80
            $cellcount = $pdf->MultiCell(80,6,$row['cell1data'],0,'L',0,0);
            $maxnocells = ($cellcount > $maxnocells) ? $cellcount : $maxnocells;
            $cellcount = $pdf->MultiCell(80,6,$row['cell2data'],0,'L',0,0);
            $maxnocells = ($cellcount > $maxnocells) ? $cellcount : $maxnocells;
            $cellcount = $pdf->MultiCell(80,6,$row['cell3data'],0,'L',0,0);
            $maxnocells = ($cellcount > $maxnocells) ? $cellcount : $maxnocells;
            $pdf->SetXY($startX,$startY);

            //now do borders and fill
            //cell height is 6 times the max number of cells
            $pdf->MultiCell(80,$maxnocells * 6,'','LR','L',0,0);
            $pdf->MultiCell(80,$maxnocells * 6,'','LR','L',0,0);
            $pdf->MultiCell(80,$maxnocells * 6,'','LR','L',0,0);

            $pdf->Ln();
        }
    }
}