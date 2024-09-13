<?php

if (!empty($_FILES['file'])) {
    $documentDirectory = 'documents/';
    $videoDirectory = 'videos/';
    $fileName = basename($_FILES['file']['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array($fileExtension, array('pdf', 'docx'))) {
        $documentFilePath = $documentDirectory . $fileName;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $documentFilePath)) {
            echo 'File Uploaded Successfully';
        } else {
            echo 'Error uploading file';
        }
    } elseif (in_array($fileExtension, array('mp4', 'avi', 'mov'))) {
        $videoFilePath = $videoDirectory . $fileName;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $videoFilePath)) {
            echo 'Video File Uploaded Successfully';
        } else {
            echo 'Error uploading video file';
        }
    } else {
        echo 'Invalid file type';
    }
}


?>

// if(!empty($_FILES['file'])){
//     $documentDirectory = 'documents/';
//     $videoDirectory = 'videos/';
//     $fileName = basename($_FILES['file']['name']);
//     $documentFilePath = $documentDirectory.$fileName;

//     if(!move_uploaded_file($_FILES['file']['tmp_name'], $documentFilePath)){
//         echo 'File Uploaded Successfully';
//     }
// }




// if(!empty($_FILES['file'])){
//     $documentDirectory = 'documents/';
//     $videoDirectory = 'videos/';
//     $fileName = basename($_FILES['file']['name']);
//     $fileMimeType = mime_content_type($_FILES['file']['tmp_name']);

//     if(strpos($fileMimeType, 'application/pdf') !== false){
//         $documentFilePath = $documentDirectory.$fileName;
//         if(move_uploaded_file($_FILES['file']['tmp_name'], $documentFilePath)){
//             echo 'PDF File Uploaded Successfully';
//         } else {
//             echo 'Error uploading PDF file';
//         }
//     } elseif(strpos($fileMimeType, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') !== false){
//         $documentFilePath = $documentDirectory.$fileName;
//         if(move_uploaded_file($_FILES['file']['tmp_name'], $documentFilePath)){
//             echo 'DOCX File Uploaded Successfully';
//         } else {
//             echo 'Error uploading DOCX file';
//         }
//     } elseif(strpos($fileMimeType, 'video/') !== false){
//         $videoFilePath = $videoDirectory.$fileName;
//         if(move_uploaded_file($_FILES['file']['tmp_name'], $videoFilePath)){
//             echo 'Video File Uploaded Successfully';
//         } else {
//             echo 'Error uploading video file';
//         }
//     } else {
//         echo 'Invalid file type';
//     }
// }