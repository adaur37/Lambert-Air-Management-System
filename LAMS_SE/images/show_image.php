<!-- UNDER CONSTRUCTION, WILL SHOW FULLSIZE IMG OF BOOK COVER ON CLICK THRU PRODUCT CATALOG -->
<?php include '../view/header.php'; ?>
<h4>IMAGE VIEWER //</h4>
<?php
    session_start(); 
    //print $_SESSION['fullsize_img']."\n";
    $fullsize_img = $_SESSION['fullsize_img']; //retrieve image path for image to display from prev page
    $fullsize_img = substr( $fullsize_img, strrpos($fullsize_img,"/")+1, strlen($fullsize_img) ); //Correct file path
    $img_fexten = substr( $fullsize_img, strrpos($fullsize_img,"."), strlen($fullsize_img) ); //Image file extension variable to allow all kinds of images
    $fullsize_img = substr( $fullsize_img, 0, strrpos($fullsize_img,".") ); //Trim off file extension now that its saved

    //print $fullsize_img."\n";
    $fullsize_img = $fullsize_img."_FULL".$img_fexten; //Edit image path to grab fullsize image instead of thumbnail
?>
<img src="<?php echo $fullsize_img; ?>" style="width: 80%;" />
<?php include '../view/footer.php'; ?>