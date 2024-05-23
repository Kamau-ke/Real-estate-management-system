<?php 
include '../tcpdf/tcpdf.php';
include '../components/connect.php';

class MYPDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, 'Houses with Most Likes', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Houses Report');

// Set default header and footer
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Initialize HTML variable with styles
$html = '<style>
            h1 { color: #333; }
            h2 { color: #007BFF; }
            p { font-size: 12pt; line-height: 1.6; }
            img { width: 100px; height: auto; }
        </style>
        <h1>Houses with Most Likes</h1>';

// Prepare SQL query
$query = 'SELECT p.property_name, p.image_01, p.description, COUNT(l.id) AS likes_count 
          FROM property p
          LEFT JOIN user_likes l ON p.id = l.property_id  
          GROUP BY p.id
          ORDER BY likes_count DESC';

$result = $conn->query($query);

if ($result === false) {
    die("Error in query: " . $conn->connect_error);
}

// Fetch data and build HTML content
while ($row = $result->fetch_assoc()) {
    $html .= '<h2>' . htmlspecialchars($row['property_name']) . '</h2>';
    if (!empty($row['image_01'])) {
        $html .= '<img src="../path/to/images/' . $row['image_01'] . '" alt="Property Image">';
    }
    $html .= '<p>' . htmlspecialchars($row['description']) . '</p>';
    $html .= '<p>Likes: ' . $row['likes_count'] . '</p>';
}

// Print text using writeHTML()
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('houses_report.pdf', 'I');
?>
