<?php
  include('lib/twitterLib.php');
  include('lib/Job.php');

  if(isset($_GET['signout']))
  {
    session_destroy();
    header('location:search.php?q='.$_GET['q']);
  }

  $q = $_GET['q'];
  $obj = new twitterLib();
  $jobObj = new Job();
  $jobData = $jobObj->jobExists($q);

  if(!empty($jobData))
  {
    header("location:job.php?id=".$jobData['id']);
    die();
  }
  
  if(!isset($_SESSION['current_job']))
    $_SESSION['current_job'] = array();

  if(!isset($_REQUEST['oauth_verifier']))  
    $getAuthUrl = $obj->getAuthUrl('0&q='.$_REQUEST['q'], 'search.php');

  if(isset($_REQUEST['oauth_verifier']))
  {
    $access_token = $obj->authorize();
  }


  if(isset($_POST['expert_id']))
  {
    $_SESSION['expert_id'] = $_POST['expert_id'];
    $getAuthUrl = $obj->getAuthUrl($_SESSION['expert_id']);
    header('location:'. $getAuthUrl);
    die();    
  }


  $_SESSION['current_job_title'] = $q;
// $users = $obj->search($q);
  $users = $_SESSION['users'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style2.css">
<link rel="stylesheet" href="css/slicknav.css">
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
<!-- main starts here -->
<div id="main-container2"> 
  <!-- nav starts here -->
  <nav class="nav">
    <ul id="menu">
      <li class="last"><a href="#" title="Home" class="last active"> <img src="images/home.png" alt=""></a></li>
      <li><a href="#" title="How To Be Their Star"> How To Be Their Star</a></li>
      <li><a href="#" title="What is This Project About"> What is This Project About</a></li>
      <li><a href="#" title="Refer a child"> Refer a child</a></li>
      <li><a href="#" title="Contact us">Contact us</a></li>
      <li><a href="#" title="Donate">Donate</a></li>
      <p class="be">#BeAStar</p>
      <!-- social starts here -->
      <div class="social">
        <p>SHARE</p>
        <a href="#"><img src="images/facebook.png" title="facebook" alt=""></a> <a href="#"><img src="images/tweeter.png" title="Twitter" alt=""></a> </div>
      <!-- social ends here -->
    </ul>
  </nav>
  <!-- nav ends here --> 
  <!-- Wrapper Starts Here -->
  <div class="wrapper"> 
    <!-- Landing-panel Starts Here -->
    <div class="star-wrap">
      <div class="login-left-panel">
        <div class="logo"> <a href="#" title="Be A Star Logo"><img src="images/logo.png" alt=""></a></div>
        <div class="search-box3">

      <form role="form" method="GET" action="search.php">
          <input class="input2 fnt" type="text" id="q" name="q" placeholder="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>">
            <input type="submit" class="search-button" value="">
      </form>

        </div>
        
        <div class="rounded">
          <div style="z-index:99;" class="icon-tweet"><img src="images/tweet.png" alt=""></div>
          <?php 

            if(isset($_SESSION['current_user']) && !empty($_SESSION['current_user']))
            {
            ?>
          <div class="profile-info">
            <h4><span>Welcome</span> <?php echo $_SESSION['current_user']['name'];?>.</h4>
            <p>Not you? <a href="?signout=signout&q=<?php echo $_GET['q']; ?>"><u>Sign out.</</a></p>
            <div class="chop"><img style="border-radius:50%;" src="<?php echo $_SESSION['current_user']['profile_image_url'];?>" alt=""></div>
          </div>
            <?php
            }
            else
            {
              ?>
                <button onclick="window.location='<?php echo $getAuthUrl;?>'" class="signin" value="Signin" style="position: absolute;width: 250px;bottom: -17px;height: 50px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Login Twitter</button>
              <?php
            }
          ?>


        </div>
      </div>
<!--       <div class="login-right-panel2">
        <div class="block-left">
          <div class="">
            <h2>Who would you like to chat with?</h2>
          </div>
          <div class="block-one">
            <div class="information"> <img src="images/p1.png" alt="">
              <div class="info">
                <h2>John Glen</h2>
                <h5>@John_Glen</h5>
              </div>
              <p>#SpaceCamp is still such an awesome place to be.</p>
              <h6> <img alt="Tweet" src="images/grey-tweet.png"> 19 Oct 2015 </h6>
              <div class="starr"><img src="images/2.png" alt=""></div>
            </div>
            <div class="view"><img src="images/load.png" alt="Load">View more experts</div>
          </div>
          <div class="block-two">
            <div class="information"> <img src="images/p2.png" alt="">
              <div class="info">
                <h2>Edwin Buzz Aldrin</h2>
                <h5>@Edwin_Buzz_Aldrin</h5>
              </div>
              <p>It’s beautiful world we live in.</p>
              <h6> <img alt="Tweet" src="images/grey-tweet.png"> 19 Oct 2015 </h6>
              <div class="starr"><img src="images/1.png" alt=""></div>
            </div>
          </div>
          <div class="block-three">
            <div class="information2"> <img src="images/p3.png" alt="">
              <div class="info">
                <h2>John Young</h2>
                <h5>@johnyoung</h5>
              </div>
              <p>#livingfree</p>
              <h6> <img alt="Tweet" src="images/grey-tweet.png"> 19 Oct 2015 </h6>
              <div class="starr"><img src="images/3.png" alt=""></div>
            </div>
          </div>
        </div>
        <div class="inner-right">
          <div class="steps">
            <ul>
              <li><a href="#"><img src="images/dot.png" alt="">Step 1</a></li>
              <li><a href="#"><img src="images/selected-dot.png" alt="">Step 2</a></li>
              <li><a href="#"><img src="images/dot.png" alt="">Step 3</a></li>
            </ul>
          </div>
        </div>
      </div>
 -->
      <div class="login-right-panel2">
        <div class="block-left">
          <div class="">
            <h2>Who would you like to chat with?</h2>
          </div>
          
          <?php
          if(!empty($users))
          {
            $count = 0;
            $startArr = array("one" => 1, "two" => 2, "three" => 3);
            foreach ($users as $key => $job) {
              // echo "<pre>";
              // print_r($job);
              // die();
              $count++;

              if($count <= 3 )
                $display = 'block;';
              else
                $display = 'none;';

              $class = 'one';

              if($count % 2 == 0)
                $class = 'two';
              else if($count % 3 == 0)
                $class = 'three';

            ?>
              <div class="block-<?php echo $class; ?>" style="display:<?php echo $display;?>">
                <div class="information"> <img style="border-radius:50%; margin-bottom:10px;" src="<?php echo str_replace('normal', 'bigger', $job['profile_image_url']);?>" alt="">
                  <div class="info">
                    <h2><?php echo $job['name'];?></h2>
                    <h5>@<?php echo $job['screen_name'];?></h5>
                  </div>
                  <p><?php echo substr($job['status'], 0, 70).'...'; ?></p>
                  <h6> <img alt="Tweet" src="images/grey-tweet.png"> <?php echo $job['created_at']; ?></h6>
                  <div class="starr"><img src="images/<?php echo $startArr[$class];?>.png" alt=""></div>
                </div>
<!--                 <div class="view"><img src="images/load.png" alt="Load">View more experts</div> -->
              </div>


            <?php

            }
          }
          ?>
              <div id="pagination"></div>



        </div>
        <div class="inner-right">
          <div class="steps">
            <ul>
              <li><a href="#"><img src="images/dot.png" alt="">Step 1</a></li>
              <li><a href="#"><img src="images/selected-dot.png" alt="">Step 2</a></li>
              <li><a href="#"><img src="images/dot.png" alt="">Step 3</a></li>
            </ul>
          </div>
        </div>
      </div>      
    </div>
    <!-- Landing-panel Ends Here --> 
    
  </div>
  <div class="clear"></div>
  <!-- Wrapper Ends Here -->
  <div class="logo2"><img src="images/make-logo.png" alt="Logo"></div>
  <div class="clear"></div>
  <!-- footer starts here -->
  <footer class="footer">
    <p>copyright 2014 |  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac nulla nunc.</p>
  </footer>
  <!-- footer ends here --> 
</div>
<!-- main ends here -->
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/jquery.bootpag.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#menu').slicknav();

$('#pagination').bootpag({
            total: 10
        }).on("page", function(event, /* page number here */ num){
             $("#content").html("Insert content"); // some ajax content loading...
});

});
</script>
</html>
