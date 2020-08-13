<?php

 function checkSchool($schoolType){
   if ($schoolType == 'owalla') {
     require_once('process/config/configOwalla.php');
   }
 }

 $schoolType = $_GET['schoolType'];
 checkSchool($schoolType);
 require_once('process/database.php');

 $conn = $database;

require("fpdf/fpdf.php");
class PDF extends FPDF {
    const DPI = 150;
    const MM_IN_INCH = 25.4;
    /*const A4_HEIGHT = 210;
    const A4_WIDTH = 297;*/
    const Legal_HEIGHT = 215;
    const Legal_WIDTH = 350;
    // tweak these values (in pixels)
    const MAX_WIDTH = 1150;
    const MAX_HEIGHT = 1650;
    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }
    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }
    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);
        // you will probably want to swap the width/height
        // around depending on the page's orientation
        $this->Image(
            $img, (self::Legal_HEIGHT - $width) / 2,
            (self::Legal_WIDTH - $height) / 2,
            $width,
            $height
        );
    }

    function header(){
        /*$this->Image('bg.jpg',0,0,300,300);*/
        /*$this->centreImage('bg.jpg',0,0);*/
        $this->SetFont('Arial','B',14);
        $this->cell(195,5,'SJCMS PORTAL RESULT CHECKING PIN AND SERIALS',0,0,'C');
        $this->Ln();
        $this->Ln();
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->cell(20,5,'S/N',1,0,'C');
        $this->cell(88,5,'PIN',1,0,'C');
        $this->cell(88,5,'SERIAL',1,0,'C');
        $this->Ln();
    }

    function viewTable($conn){
        $this->SetFont('Times','',12);
        $sql = "SELECT * FROM card_print";
        $result = $conn->query($sql);
        $cnt=1;
        while ($row = $result->fetch_assoc()) {
            $this->cell(20,5,$cnt++,1,0,'C');
            $this->cell(88,5,$row["pin"],1,0,'C');
            $this->cell(88,5,$row["serial"],1,0,'C');
            $this->Ln();
        }
    }
}
// usage:
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();
?>
