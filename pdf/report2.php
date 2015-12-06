<?php

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'zanim.gif';
        $this->Image($image_file, 15, 10, 30, '', 'gif', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
        // Set font
        $this->SetFont('cordiaupc', 'B', 22);
		$this->writeHTMLCell(100,10,45,19,'<font color="#FF641A">ข้อมูลการสั่งซื้อสินค้า</font>');
		$this->writeHTMLCell(100,10,45,27,'<font color="#FF641A" size="18">ร้าน  Zanim shop</font>');
		
		
		$year = date('Y')+543;
		$this->writeHTMLCell(300,10,175,3,'<font size="10"> วันที่ : '.date('d').'/'.date('m').'/'.$year.'</font>');
        // Title
        //$this->Cell(0, 20, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('cordiaupc', 'B', 15);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('cordiaupc', 'B', 15);


// add a page
$pdf->AddPage();

include ("dbconnect.php");
$sql = "SELECT * FROM student";
mysql_query('set names utf8');
$result = mysql_query ( $sql ) ;
session_start();
	

$html = '<br><br><br><br><table cellspacing="0" cellpadding="5" border="1" width="650">
            <tr>
                <th>#</th><th>name</th><th>order</th><th>salary</th>
               
            </tr>
            ';
                           $_SESSION['order'] = isset($_SESSION['order'])?$_SESSION['order']:'';
                           $order = explode('|',$_SESSION['order']);

                           $_SESSION['monny'] = isset($_SESSION['monny'])?$_SESSION['monny']:'';
                           $monny = explode('|',$_SESSION['monny']);

                            $_SESSION['name_shop'] = isset($_SESSION['name_shop'])?$_SESSION['name_shop']:'';
                           $name_shop = explode('|',$_SESSION['name_shop']);
                           $cout_monney=0;
                           $cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
                           for($i=1;$i<$cout_shop+1;$i++){

          
                                   $html .= '<tr>';
                                            $html .= "<td>".$i."</td>";
                                             $html .= "<td>$name_shop[$i]</td>";
                                             $html .= "<td>$order[$i]</td>";
                                            $mon = $order[$i]*$monny[$i];
                                             $html .= "<td>$mon</td>";
                                            $cout_monney +=$mon;
                                             
                                    $html .= '</tr>';
                                
                           };
                                          
                           $html.='<tr><td></td><td></td><td></td><td bgcolor="#99ff99">'.$cout_monney.'</td></tr>';

                           $html.='</table>';







// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output('report.pdf', 'FI');

//============================================================+
// END OF FILE                                                
//============================================================+