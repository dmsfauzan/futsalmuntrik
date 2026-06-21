<?php
if (!isset($_GET['file'])) {
    die("File tidak ditemukan.");
}

$filename = basename($_GET['file']);
$filepath = __DIR__ . '/../uploads/bukti/' . $filename;
if (!file_exists($filepath)) {
    die("File tidak tersedia.");
}

$ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
switch ($ext) {
    case 'pdf':
        header('Content-Type: application/pdf');
        break;
    case 'jpg':
    case 'jpeg':
        header('Content-Type: image/jpeg');
        break;
    case 'png':
        header('Content-Type: image/png');
        break;
    default:
        die("Format file tidak didukung.");
}

header("Content-Disposition: inline; filename=\"$filename\"");
readfile($filepath);
exit;
?>
