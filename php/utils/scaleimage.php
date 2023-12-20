<?php

function scale_image( $sourcePath, $targetWidth, $targetHeight, $outputPath ) {


    // Get the dimensions of the original image
    list($sourceWidth, $sourceHeight, $sourceType) = getimagesize($sourcePath);

    // Calculate the aspect ratio
    $sourceAspectRatio = $sourceWidth / $sourceHeight;

    // Calculate the target dimensions while maintaining the aspect ratio
    if ($targetWidth / $targetHeight > $sourceAspectRatio) {
        $targetWidth = $targetHeight * $sourceAspectRatio;
    } else {
        $targetHeight = $targetWidth / $sourceAspectRatio;
    }

    // Create a new image resource based on the source image type
    if ($sourceType == IMAGETYPE_PNG) 
        $sourceImage = imagecreatefrompng($sourcePath);
    else 
        $sourceImage = imagecreatefromjpeg($sourcePath);

    // Create a new true color image with the target dimensions
    $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

    // Preserve transparency for PNG and GIF images
    if ($sourceType == IMAGETYPE_PNG) {
        imagecolortransparent($targetImage, imagecolorallocatealpha($targetImage, 0, 0, 0, 127));
        imagealphablending($targetImage, false);
        imagesavealpha($targetImage, true);
    }

    // Resize the image to the target dimensions
    imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);

    // Save the scaled image to the specified output path
    imagejpeg($targetImage, $outputPath); // Change this to imagepng or imagegif if needed

    // Free up memory by destroying the image resources
    imagedestroy($sourceImage);
    imagedestroy($targetImage);
}

// // Example usage
// $sourceImagePath = 'path/to/your/image.jpg';
// $targetWidth = 300; // Set your desired width
// $targetHeight = 200; // Set your desired height
// $outputImagePath = 'path/to/your/output/image.jpg';

// scale_image($sourceImagePath, $targetWidth, $targetHeight, $outputImagePath);

?>
