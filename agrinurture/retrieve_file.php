<?php
// Connect to the database
include './admin/db.php';

// Check if file ID is provided
if (isset($_GET['ID'])) {
    $fileId = intval($_GET['ID']);

    // Query to fetch file details
    $stmt = $conn->prepare("SELECT file_name, file_type, file_data FROM uploaded_files WHERE ID = ?");
    $stmt->bind_param("i", $fileId);
    $stmt->execute();
    $stmt->bind_result($fileName, $fileType, $fileData);
    $stmt->fetch();
    $stmt->close();

    if ($fileData) {
        // Set headers to display or download the file
        header("Content-Type: " . $fileType);
        header("Content-Length: " . strlen($fileData));

        if (isset($_GET['download'])) {
            header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
        } else {
            header("Content-Disposition: inline; filename=\"" . $fileName . "\"");
        }

        // Output the file data
        echo $fileData;
        exit;
    } else {
        echo "File not found.";
    }

    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    // Check if it's a Word document
    if ($fileExtension == 'doc' || $fileExtension == 'docx') {
        // Generate Google Docs Viewer URL for the Word document
        $googleDocsViewerURL = "https://docs.google.com/gview?url=" . urlencode($filePath) . "&embedded=true";

        // Display the document in an iframe
        echo '<iframe src="' . $googleDocsViewerURL . '" width="800" height="600"></iframe>';
    } else {
        // Default file handling (for PDFs or other types)
        header("Content-Type: $fileType");
        header("Content-Length: " . filesize($filePath));
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        readfile($filePath);
    }


} else {
    echo "Invalid request.";
}

$conn->close();
?>
