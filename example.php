<?php
  include ('/php/pagination.class.php');

  $seite = 1;                   //Starting Page is 1
  if(isset($_GET["seite"])) {
      $seite = $_GET["seite"];    //If there is a page set in $_GET, then use this as the page
  }

  $numberOfImages = 100;                  //We have 100 Images here
  $perPage = 25;                          //We want to display 25 images per page
  $startingImage = ($seite-1) * $perPage;  //The starting image is this one, starting by zero
  $lastImage = $startingImage + $perPage; //The last image is the starting image + images per Page
  if ($lastImage >= $numberOfImages) {
    $lastImage = $numberOfImages - 1;     //If we would render more images than we have, the last image is the maximum number of images
  }
  $pagination = new Pagination ($_GET, $seite, $gesamteSeitenZahl);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Paginated Gallery Example</title>
  <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="js/dropinbox.js"></script>
  <link rel="stylesheet" href="css/dropinbox.css" type="text/css" media="screen" charset="utf-8" />
  <script type="text/javascript">
  $(window).load(function(){
  //Layer
  	$('#gallery').paginatedGallery();
  });
  </script>
</head>
<body>
  <div class="wrapper">
      <h1>Paginated Gallery</h1>
      <p>
          This images are for testing purposes only.
      </p>
  </div>
  <div id="gallery">
    <div class="thumbnails">
      <?php for ($i = $startingImage; $i <= $lastImage; $i++){ ?>
          <a href="#big-image-<?php echo $i; ?>"><img src="http://placekitten.com/50/50" alt="Kitten!" /></a>
      <?php } ?>
    </div>
    <div class="bigpicture">
        <?php for ($i = $startingImage; $i <= $lastImage; $i++){ ?>
            <img id="big-image-<?php echo $i; ?>" src="http://placekitten.com/200/200" alt="Big Kitten!" /></a>
        <?php } ?>
    </div>
    <?php $pagination->getPagination(); ?>
  </div>
<!-- Add your content here-->
</body>
</html>
