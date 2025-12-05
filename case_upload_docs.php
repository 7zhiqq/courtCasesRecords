<?php
    require_once 'include/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $case_id            = mysqli_real_escape_string($conn, $_POST['case_number']);
        $document_title     = mysqli_real_escape_string($conn, $_POST['document_title']);
        $description        = mysqli_real_escape_string($conn, $_POST['document_description'] ?? '');

        $file               = $_FILES['document_file'];
        $fileName           = $file['name'];
        $fileTmp            = $file['tmp_name'];
        $fileSize           = $file['size'];
        $fileError          = $file['error'];

        $allowed_ext = ['pdf', 'doc', 'docx', 'jpg', 'png'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileError !== 0) {
            echo "<script>alert('Error uploading file!'); history.back();</script>";
            exit();
        }

        if (!in_array($fileExt, $allowed_ext)) {
            echo "<script>alert('Invalid file type! Allowed: PDF, DOC, DOCX, JPG, PNG'); history.back();</script>";
            exit();
        }

        if ($fileSize > 20 * 1024 * 1024) {  
            echo "<script>alert('File too large! Maximum size is 20MB'); history.back();</script>";
            exit();
        }

        $newFileName = uniqid('DOC_', true) . '.' . $fileExt;
        $uploadFolder = 'uploads/case_docs/' . $case_id;

        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        $destination = $uploadFolder . '/' . $newFileName;

        if (move_uploaded_file($fileTmp, $destination)) {

            $query = "INSERT INTO case_documents_tbl (case_id, document_type, document_title, file_path, description)
                      VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);
            
            $document_type = $fileExt;

            mysqli_stmt_bind_param($stmt, "sssss", $case_id, $document_type, $document_title, $destination, $description);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: case_view.php?case=$case_id&tab=documents&status=success");
                exit();
            } else {
                unlink($destination); 
                echo "<script>alert('Failed to save document in database!'); history.back();</script>";
                exit();
            }
        }

        echo "<script>alert('Failed to upload file!'); history.back();</script>";
        exit();
    } else {
        header("Location: cases.php");
        exit();
    }
?>