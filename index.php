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
<div class="cloude"><img src="images/clouds.gif" alt=""></div>

<!--<div class="images-gis">
<div class="gif-image1"><img src="images/123.gif"></div>
<div class="gif-image2"><img src="images/123.gif"></div>
<div class="gif-image3"><img src="images/123.gif"></div>
<div class="gif-image4"><img src="images/123.gif"></div>
<div class="gif-image5"><img src="images/123.gif"></div>
<div class="gif-image6"><img src="images/123.gif"></div>
<div class="gif-image7"><img src="images/123.gif"></div>
<div class="gif-image8"><img src="images/123.gif"></div>
<div class="gif-image9"><img src="images/123.gif"></div>
</div>-->
<!-- main starts here -->
<div id="main-container">
<!-- nav starts here -->
  <?php include('inc/header.php'); ?>
<!-- nav ends here -->
<!-- social starts here -->

<!-- social ends here -->
<div class="wrapper">
<div class="cont-panel">
<div class="logo">
<a href="#" title="Be A Star Logo"><img src="images/logo.png" alt=""></a></div>

<p>Wishes bear great power. They inspire hope for the future. Nurture courage for challenges. And they transform the lives of many, whether or not you’re battling a life-threatening illness.</p> 

</div>

<div class="circle-panel">
<div class="left-panel">
	<div class="blue-circle" style="cursor:pointer;" onclick="redirectToSearch();">
    <h3>STEP 1</h3>
    <img src="images/half-search.png" class="half-serach">
    <p>Tell us what you<br>wish to become</p></div>
        <a href="#"><img src="images/arrow.png" class="arrow" alt="Arrow"></a>
    </div>
    
    
    <div class="left-panel">
	<div class="blue-circle" style="cursor:pointer;" onclick="redirectToSearch();">
    <h3>STEP 2</h3>
    <div class="tweet"><img src="images/tweet.png"></div>
    <p>Log in to your Twitter account to ask for advice</p></div>
                <a href="#"><img src="images/arrow.png" class="arrow" alt="Arrow"></a>

    </div>
    
    <div class="left-panel">
	<div class="blue-circle" style="cursor:pointer;" onclick="redirectToSearch();">
    <h3>STEP 3</h3>
    <div class="tweet"><img src="images/comment.png"></div>
    <p>Connect and chat with someone who knows how to make your wish happen</p></div>

    </div>
    
    </div>
    <div class="clear"></div>
<div class="close">x Close</div> 
</div>
<div class="clear"></div>
   <div class="logo2"><img src="images/make-logo.png" alt="Logo"></div>

<?php 
  include('inc/footer.php');

?>
</html>
