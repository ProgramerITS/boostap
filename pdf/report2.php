<?php

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 15, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
        // Set font
        $this->SetFont('cordiaupc', 'B', 22);
		$this->writeHTMLCell(100,10,45,19,'<font color="#FF641A">ข้อมูลนักศึกษา</font>');
		$this->writeHTMLCell(100,10,45,27,'<font color="#FF641A" size="18">คณะวิทยาศาสตร์</font>');
		$this->writeHTMLCell(300,10,45,33,'<font color="#FF641A" size="18">เลขที่ 11 ถ.อู่ทอง</font>');
		
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

	

$html = '<br><br><br><br><table cellspacing="0" cellpadding="5" border="1" width="650">
            <tr>
                <td width="150" height="30" bgcolor="#FF6633" align=""><font color="#FFFFFF" size="+3">รหัสนักศึกษา</font></td>
          		
				<td width="200" align="center" bgcolor="#FF6633"><font color="#FFFFFF"  size="+3">ชื่อ-นามสกุล</font></td>
              
				<td width="300" align="center" bgcolor="#FF6633"><font color="#FFFFFF"  size="+3">จังหวัด</font></td> 
               
            </tr>
            ';
while ($rs = mysql_fetch_array($result)) { 

if($bg == "#FFFF99") { //ส่วนของการ สลับสี 
$bg = "#FFFFCC";
} else {
$bg = "#FFFF99";
}

$html.='<tr><td align="center" bgcolor="'.$bg.'">'.$rs['student_id'].'</td>
                <td  bgcolor="'.$bg.'">'.$rs['firstname'].'  '.$rs['lastname'].'</td>
                 <td bgcolor="'.$bg.'">'.$rs['province'].'</td></tr>';
}

$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output('report.pdf', 'FI');

//============================================================+
// END OF FILE                                                
//============================================================+