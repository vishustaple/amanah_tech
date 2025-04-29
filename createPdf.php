<?php
if (isset($_FILES['pdf'])) {
    $pdf = $_FILES['pdf'];
    // Define the target directory and file name
    $targetDir = "uploads/";  // Change this to your desired directory
    $targetFile = $targetDir . time() . basename($pdf['name']);  // Use the original filename
    // Check if the file is a valid PDF
    if ($pdf['type'] == 'application/pdf') {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($pdf['tmp_name'], $targetFile)) {
            echo json_encode(['success' => true, 'message' => 'PDF saved successfully!','filePaths' => $targetFile,'file' =>$pdf]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save PDF on the server.','file' =>$pdf]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid file type. Only PDF files are allowed','file' =>$pdf['type']]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.','file' =>$pdf]);
}
?> 
