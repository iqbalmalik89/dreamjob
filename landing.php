<?php
  include('lib/twitterLib.php');
  include('lib/Job.php');
  $newjob = new Job();
  $featuredExperts = $newjob->getFeaturedExperts();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<?php include('inc/asset.php'); ?>
<title>Be a Star</title>
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if gte IE 9]>
<style type="text/css">
.gradient {
   filter: none;
}
</style>
<![endif]-->
</head>

<body>

<?php


?>
<div class="cloude"><img src="images/clouds.gif" alt=""></div>
<!-- main starts here -->
<div id="main-container2">
 
  <!-- nav starts here -->
  <?php include('inc/header.php'); ?>
  <!-- nav ends here --> 
  <!-- Wrapper Starts Here -->
  <div class="wrapper"> 
    <!-- Landing-panel Starts Here -->
    <div class="landing-wrap">
      <div class="landing-left-panel">
        <div class="star">
          <?php 
          if(isset($featuredExperts[0])) {
            ?>
          <div class="profile"><img style="border-radius:50%;" src="<?php if(isset($featuredExperts[0]['pic'])) echo $featuredExperts[0]['pic']; ?>" alt="Image" class="pic">
            <h2><?php if(isset($featuredExperts[0]['job_title'])) echo $featuredExperts[0]['job_title']; ?></h2>
            <div class="heading">
              <h6><?php if(isset($featuredExperts[0]['name'])) echo $featuredExperts[0]['name']; ?></h6>
              <h6><span>@<?php if(isset($featuredExperts[0]['name'])) echo $featuredExperts[0]['username']; ?></span></h6>
            </div>
            <p><img src="images/grey-tweet.png" alt="Tweet"><?php if(isset($featuredExperts[0]['created_date'])) echo date('d M Y', strtotime($featuredExperts[0]['created_date'])); ?></p>
          </div>

          <?php
          }
          ?>

        </div>
      </div>
      <div class="landing-left-panel">
        <div class="cont-panel">
          <div class="logo"> <a href="#" title="Be A Star Logo"><img src="images/logo.png" alt=""></a></div>
          <p>Wishes bear great power. They inspire hope for the future. Nurture courage for challenges. And they transform the lives of many, whether or not you’re battling a life-threatening illness. </p>
          <p> Harness the power of wishes and watch how you can shine. Share your wish right here and chat to people who will light the way. </p>
          <div class="search-box">
      <form role="form" method="GET" action="search.php">

            <input type="text" id="q" name="q" class="input" placeholder="I wish to become...">
            <input type="submit" class="search-button" value="">
      </form>
          </div>
          <div class="blue"><img src="images/not-icon.png" alt="Icon">How to map your path to becoming a star</div>
        </div>
      </div>
      <div class="landing-left-panel">
        <div class="starR">

          <?php 
          if(isset($featuredExperts[1])) {
            ?>
          <div class="profile"><img style="border-radius:50%;" src="<?php if(isset($featuredExperts[1]['pic'])) echo $featuredExperts[1]['pic']; ?>" alt="Image" class="pic">
            <h2><?php if(isset($featuredExperts[1]['job_title'])) echo $featuredExperts[1]['job_title']; ?></h2>
            <div class="heading">
              <h6><?php if(isset($featuredExperts[1]['name'])) echo $featuredExperts[1]['name']; ?></h6>
              <h6><span>@<?php if(isset($featuredExperts[1]['name'])) echo $featuredExperts[1]['username']; ?></span></h6>
            </div>
            <p><img src="images/grey-tweet.png" alt="Tweet"><?php if(isset($featuredExperts[1]['created_date'])) echo date('d M Y', strtotime($featuredExperts[1]['created_date'])); ?></p>
          </div>

          <?php
          }
          ?>

        </div>
      </div>
    </div>
    <!-- Landing-panel Ends Here -->
    <div class="image">
      <div class="trance-box">
        <h6>Be Inspired!</h6>
        <p>Witness the power of<br>
          dreams here,</p>
        <p><a href="#"><i>View More</i><img src="images/more.png" alt="Icon"></a></p>
      </div>
      <div class="img-box"><img src="images/botm-pic1.png" alt=""></div>
      <div class="img-box"><img src="images/botm-pic2.png" alt=""></div>
    </div>
  </div>
  <!-- Wrapper Ends Here -->
  <div class="logo2"><img src="images/make-logo.png" alt="Logo"></div>
  <div class="clear"></div>
  <!-- footer starts here -->
<?php 
  include('inc/footer.php');
?>
</html>
