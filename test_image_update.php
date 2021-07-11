<?php
// Submit Dependence Here
// DELETE THE OLD TO REPLACE WITH THE NEW
$result_delete = mysqli_query($connect, "DELETE FROM dependency WHERE svn ='$svn'");

// Keep track of the existing image paths
$existing_image_paths = $_POST['existing_image'];

foreach ($_POST['namee'] as $key => $value) {
    $gendere = mysqli_real_escape_string($connect, $_POST['gendere'][$key]);
    $agee = mysqli_real_escape_string($connect, $_POST['agee'][$key]);
    $relationshipe = mysqli_real_escape_string($connect, $_POST['relationshipe'][$key]);
    $occupatione = mysqli_real_escape_string($connect, $_POST['occupatione'][$key]);
    $value = mysqli_real_escape_string($connect, $value);

    // File Upload Section
    $target_dir = "images/"; // this is the directory to upload to
    $timestamp = time() . '_' . $key;
    $target_file_resized = '';

    // Check if a new image is uploaded for this dependent
    if ($_FILES["new_image"]["size"][$key] > 0) {
        // File upload and image resizing logic here
        $file = $_FILES['new_image']['tmp_name'][$key];
        $source_properties = getimagesize($file);
        $image_type = $source_properties[2];
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["new_image"]["tmp_name"][$key]);
        if ($check === false) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($image_type != IMAGETYPE_JPEG && $image_type != IMAGETYPE_PNG && $image_type != IMAGETYPE_GIF) {
            $uploadOk = 0;
        }

        // Resize image to reduce file size if upload is valid
        if ($uploadOk) {
            $new_width = 300; // Set your desired width
            $new_height = 300; // Set your desired height
            
            // Create a new image resource based on the file type
            switch ($image_type) {
                case IMAGETYPE_JPEG:
                    $image_resource_id = imagecreatefromjpeg($file);
                    break;
                case IMAGETYPE_PNG:
                    $image_resource_id = imagecreatefrompng($file);
                    break;
                case IMAGETYPE_GIF:
                    $image_resource_id = imagecreatefromgif($file);
                    break;
            }

            // Create a new true color image with the desired dimensions
            $image_resized = imagecreatetruecolor($new_width, $new_height);

            // Resample the original image to the new image with the desired dimensions
            imagecopyresampled($image_resized, $image_resource_id, 0, 0, 0, 0, $new_width, $new_height, $source_properties[0], $source_properties[1]);

            // Save the resized image to the target directory
            $target_file_resized = $target_dir . $timestamp . '_resized.' . image_type_to_extension($image_type);
            imagejpeg($image_resized, $target_file_resized, 50); // Adjust quality as needed

            // Free up memory
            imagedestroy($image_resource_id);
            imagedestroy($image_resized);
        }
    }

    // Check if an existing image path exists for this dependent
    if (!empty($existing_image_paths[$key])) {
        // If an existing image path exists, use it
        $existing_image_path = mysqli_real_escape_string($connect, $existing_image_paths[$key]);
        $sql_statement2 = "INSERT INTO dependency (name, gender, age, relation, occupation, svn, image_path) VALUES ('$value', '$gendere', '$agee', '$relationshipe', '$occupatione', '$svn', '$existing_image_path')";
        $result = mysqli_query($connect, $sql_statement2);
    } elseif (!empty($target_file_resized)) {
        // If a new image is uploaded, insert the new image path
        $sql_statement2 = "INSERT INTO dependency (name, gender, age, relation, occupation, svn, image_path) VALUES ('$value', '$gendere', '$agee', '$relationshipe', '$occupatione', '$svn', '$target_file_resized')";
        $result = mysqli_query($connect, $sql_statement2);
    }
}
