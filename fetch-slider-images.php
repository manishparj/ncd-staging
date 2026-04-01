<?php
include('./config/config.php');


$slider_id = $_POST['slider_id'] ?? 0;

// Get slider info (for fallback)
$sql_slider = "SELECT doc_upload FROM slider WHERE id = ?";
$q_slider = $dbh->prepare($sql_slider);
$q_slider->execute([$slider_id]);
$slider = $q_slider->fetch(PDO::FETCH_OBJ);

// Get all images
$sql = "SELECT image_path 
        FROM slider_images 
        WHERE slider_id = ? 
        ORDER BY is_cover DESC, image_order ASC";

$query = $dbh->prepare($sql);
$query->execute([$slider_id]);

$images = $query->fetchAll(PDO::FETCH_OBJ);

// ✅ FIX: If no images → use cover image
if (empty($images) && !empty($slider->doc_upload)) {
    $images = [
        (object)[
            'image_path' => $slider->doc_upload
        ]
    ];
}

echo json_encode($images);
?>