<?php
if ($_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode([
        "success" => false,
        "message" => "File upload failed with error code: " . $_FILES['pdf']['error']
    ]);
    exit;
}

if (mime_content_type($_FILES['pdf']['tmp_name']) !== 'application/pdf') {
    echo json_encode([
        "success" => false,
        "message" => "Invalid file type. Only PDF files are allowed"
    ]);
    exit;
}

// Now move the uploaded file to your desired location
$targetPath = "uploads/" . time() . basename($_FILES['pdf']['name']);
move_uploaded_file($_FILES['pdf']['tmp_name'], $targetPath);

echo json_encode([
    "success" => true,
    "message" => "PDF saved successfully!",
    "filePaths" => $targetPath
]);
?>
