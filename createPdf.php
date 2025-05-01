<?php
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '12M');
ini_set('memory_limit', '64M');
if (isset($_FILES['pdf'])) {
    $pdf = $_FILES['pdf'];

    if ($pdf['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Upload error code: ' . $pdf['error'], 'file' => $pdf]);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $pdf['tmp_name']);
    finfo_close($finfo);

    if ($mime !== 'application/pdf') {
        echo json_encode(['success' => false, 'message' => 'Invalid file type. Only PDF files are allowed', 'mime' => $mime, 'file' => $pdf]);
        exit;
    }

    $targetDir = "uploads/";
    $targetFile = $targetDir . time() . basename($pdf['name']);

    if (move_uploaded_file($pdf['tmp_name'], $targetFile)) {
        echo json_encode([
            'success' => true,
            'message' => 'PDF saved successfully!',
            'filePaths' => $targetFile,
            'file' => $pdf
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save PDF on the server.', 'file' => $pdf]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
}
?>
