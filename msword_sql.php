<?php  
  require 'vendor_word/autoload.php'; // Include the autoload file for phpoffice/phpword
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORD Viewer</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="word_document">Upload WORD Document:</label>
        Select WORD file to upload:
        <input type="file" name="word_file" accept=".docx">
        <input type="submit" value="Upload and Compare">
    </form>
    <?php
   
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_FILES['word_file'])) {
       $wordFile = $_FILES['word_file']['tmp_name'];
        $document = \PhpOffice\PhpWord\IOFactory::load($wordFile);
       
    
        // Extract text content from the Word file
        $wordText = "";
        foreach ($document->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    $wordText .= $element->getText() . " "; // Add a space between elements
                }
            }
        }

        echo "Show here: $wordText";
    
        // Perform database query to fetch matching values
        $db = new mysqli('localhost', 'root', '8168627861', 'naf_housing');
        $query = "SELECT svn FROM census_registration WHERE svn LIKE '%" . $wordText . "%'";
        $result = $db->query($query);
    
        // Display the Word content with matching values highlighted
        echo '<div>';
        echo '<p>';
        // Split the wordText into an array of words
        $wordArray = explode(" ", $wordText);
        foreach ($wordArray as $word) {
            // Highlight matching values
            $highlightedWord = preg_replace('/(' . preg_quote($word, '/') . ')/i', '<span style="background-color: yellow;">$1</span>', $word);
            echo nl2br($highlightedWord . " ");
        }
        echo '</p>';
        echo '</div>';
    
        // Check if the database query was successful
        if (!$result) {
            die('Error in the database query: ' . $db->error);
        }
    
        // Close the database connection
        $db->close();
    }
    
    ?>
    <br><br><br>
    <br><br>
</body>

</html>