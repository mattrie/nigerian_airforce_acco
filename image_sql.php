<?php  
require 'vendor_image/autoload.php'; // Include the autoload file for phpoffice/phpword


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Compare</title>
</head>
<body>
    <form action="image_sql.php" method="post" enctype="multipart/form-data">
        <label for="image_file">Upload Image:</label>
        <input type="file" name="image_file" accept="image/*">
        <input type="submit" value="Upload and Compare">
    </form>

    <?php
if (isset($_FILES['image_file'])) {
    $imageFile = $_FILES['image_file']['tmp_name'];

    // Define a temporary file to store the OCR result
    $ocrResultFile = 'temp_ocr_result.txt';

    // Create the temporary OCR result file (empty) to ensure it exists
    file_put_contents($ocrResultFile, '');

    // Run tesseract OCR on the image file and append the result to the temporary file
    $ocrCommand = "tesseract $imageFile $ocrResultFile";
    shell_exec($ocrCommand);

    // Read the OCR result from the temporary file
    $extractedText = file_get_contents($ocrResultFile);

    // Remove the temporary OCR result file
    unlink($ocrResultFile);

    // Perform database query to fetch matching values
    $db = new mysqli('localhost', 'root', '8168627861', 'naf_housing');
    $query = "SELECT svn FROM census_registration WHERE svn LIKE '%" . $extractedText . "%'";
    $result = $db->query($query);

    // Display the image with matching values highlighted
    echo '<div>';
    echo '<p>';
    // Highlight matching values in the extracted text
    $highlightedText = preg_replace('/(' . preg_quote($extractedText, '/') . ')/i', '<span style="background-color: yellow;">$1</span>', $extractedText);
    echo nl2br($highlightedText);
    echo '</p>';
    echo '</div>';

    // Check if the database query was successful
    if (!$result) {
        die('Error in the database query: ' . $db->error);
    }

    $ocrOutput = shell_exec($ocrCommand);
    if (!empty($ocrOutput)) {
        echo "OCR Output: $ocrOutput";
    } else {
        echo "OCR Output is empty";
    }

    // Close the database connection
    $db->close();
}
?>


</body>
</html>
