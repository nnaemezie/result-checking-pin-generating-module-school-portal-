<?php

$term = $_GET['term'];
$myschool = $_GET['myschool'];
$class = $_GET['class'];

if ($myschool == 'owalla') {
    include "../config/configOwalla.php";
}

$conn = new mysqli(db_host, db_user, db_pass, db_name);

require("fpdf/fpdf.php");

$failSub = 0;
$passSub = 0;

class PDF extends FPDF {
    const DPI = 150;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 210;
    const A4_WIDTH = 297;
    /*const Legal_HEIGHT = 215;
    const Legal_WIDTH = 350;*/
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
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }

    function header(){
        global $term;
        global $class;
        /*$this->Image('bg.jpg',0,0,300,300);*/
        /*$this->centreImage('bg.jpg',0,0);*/
        $this->SetFont('Arial','B',10);
        $this->cell(200,5,'SISTER'."'".'S OF JESUS CRUCIFIED MODEL SECONDARY SCHOOL',0,0,'C');
        $this->Ln();
        $this->cell(200,5,$term.' Scratch Card for '.$class,0,0,'C');
        $this->Ln(10);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        // $this->cell(10,10,$this->Image('http://www.traco.tracoportal.com/user/sign/sign-2.png',55,270,40),0,0,'C');
        /*$this->cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');*/
        /*$this->cell(0,10,'Nice Result Work Harder',0,0,'C');*/
    }

    function headerTable(){
        $this->SetFont('Times','B',8);
        $this->cell(7,5,'S/N',1,0,'C');
        // $this->cell(40,5,'TERM',1,0,'C');
        $this->cell(40,5,'PIN',1,0,'C');
        $this->cell(45,5,'SERIAL NUMBER',1,0,'C');
        $this->cell(60,5,'ADMISSION NUMBER',1,0,'C');
        // $this->cell(30,5,'CLASS',1,0,'C');
        $this->Ln();
    }

    function viewTable($conn){
        global $class;
        global $term;
        $sql = "SELECT * FROM card WHERE matchid != '' AND term = '$term' AND class = '$class' ";
        $result = $conn->query($sql);
        $cnt=1;
        while ($row = $result->fetch_assoc()) {
            $this->SetFont('Times','',9);
            $this->cell(7,6,$cnt++,1,0,'C');
            // $this->cell(40,6,$row['term'],1,0,'L');
            $this->cell(40,6,$row['pin'],1,0,'C');
            $this->cell(45,6,$row['serial_pin'],1,0,'C');
            $this->cell(60,6,$row['matchid'],1,0,'C');
            // $this->cell(30,6,$row['class'],1,0,'C');
            $this->Ln();
        }
    }

}
// usage:
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();
?>