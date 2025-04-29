<?php
if (isset($_FILES['pdf'])) {
    $pdf = $_FILES['pdf'];
    $targetDir = "uploads/";  // Change this to your desired directory
    $targetFile = $targetDir . time() . basename($pdf['name']);  // Use original filename

    // Validate file type
    if (mime_content_type($pdf['tmp_name']) === 'application/pdf') {
        if (move_uploaded_file($pdf['tmp_name'], $targetFile)) {
            echo json_encode([
                'success' => true,
                'message' => 'PDF saved successfully!',
                'type' =>mime_content_type($pdf['tmp_name']),
                'filePaths' => $targetFile
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'type' =>mime_content_type($pdf['tmp_name']),
                'message' => 'Failed to save PDF on the server.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'type' =>mime_content_type($pdf['tmp_name']),
            'message' => 'Invalid file type. Only PDF files are allowed.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No file uploaded.'
    ]);
}
?>
