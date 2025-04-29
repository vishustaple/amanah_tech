<?php
// createPdf.php
if (!isset($_FILES['pdf'])) {
    echo json_encode(["success" => false, "message" => "No file uploaded.",'file' => $_FILES['pdf']]);
    exit;
}

$file = $_FILES['pdf'];

// Check for upload errors
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "File upload failed with error code: " . $file['error']]);
    exit;
}

// Validate MIME type
$allowedTypes = ['application/pdf'];
$fileMimeType = mime_content_type($file['tmp_name']);

if (!in_array($fileMimeType, $allowedTypes)) {
    echo json_encode(["success" => false, "message" => "Invalid file type. Only PDF files are allowed."]);
    exit;
}

// Save file
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = time() . basename($file['name']);
$targetPath = $uploadDir . $filename;

if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo json_encode([
        "success" => true,
        "message" => "PDF saved successfully!",
        "filePaths" => $targetPath,
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to move uploaded file."]);
}
?>
