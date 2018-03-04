<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["uploaded_file"]["name"]; // The file name
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["uploaded_file"]["type"]; // The type of file it is
$fileSize = $_FILES["uploaded_file"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["uploaded_file"]["error"]; // 0 for false... and 1 for true
$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); // filter the $filename
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
$density_form = $_POST["density1"];

// START PHP Image Upload Error Handling --------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
    // This condition is only if you wish to allow uploading of specific file types    
    echo "ERROR: Your image was not .gif, .jpg, or .png.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}

// END PHP Image Upload Error Handling ----------------------------------
// Place it into your "uploads" folder mow using the move_uploaded_file() function
if (!file_exists('../resizes')) {
    mkdir('../resizes', 0777, true);
}

$moveResult = move_uploaded_file($fileTmpLoc, "../resizes/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    exit();
}

// Include the file that houses all of our custom image functions
include_once("php_image_resize_lib.php");

//Start resizing

$image_densities =  array('ldpi' => 0.75, 'mdpi'=> 1, 'tvdpi' => 1.33, 'hdpi' => 1.5, 'xhdpi' => 2,  'xxhdpi' => 3, 'xxxhdpi' => 4 );

$target_file = "../resizes/" . $fileName;

//get image width & height
list($width, $height) = getimagesize($target_file);

foreach($image_densities as $density=>$scaling_ratio)
{
    if (!file_exists('../resizes/' . $density)) {
        mkdir('../resizes/' . $density, 0777, true);
    }

    $resized_file = "../resizes/" . $density . "/" . $fileName;

    $max_width = $width * $scaling_ratio / $image_densities[$density_form];
    $max_height = $height *  $scaling_ratio / $image_densities[$density_form];

    image_resize($target_file, $resized_file, $max_width, $max_height, $fileExt);        
}

// ----------- End Adams Convert to JPG Function -----------
// Display things to the page so you can see what is happening for testing purposes
echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
echo "The file extension is <strong>$fileExt</strong><br /><br />";
echo "The Error Message output for this upload is: $fileErrorMsg";

//http_response_code(404);
//header("HTTP/1.1 404 Not Found");
?>
