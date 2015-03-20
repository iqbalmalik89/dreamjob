  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <link href="css/jquery.countdown.css" rel="stylesheet">


  <link href="css/perfect-scrollbar.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>

<script type="text/javascript" src="js/jquery.plugin.js"></script>
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
  <script src="js/perfect-scrollbar.js"></script>

  <script src="js/jquery-ui.js"></script>

<script>
$( document ).ready(function() {

  $('#userlisting').perfectScrollbar(
  {suppressScrollX:true}
    );
  

  var newYear = new Date(); 
  newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1); 
//  $('#defaultCountdown').countdown({until: 'Thu Feb 19 2015 21:28:00 GMT+0500 (PKT)'}); 

});
 
$('#removeCountdown').click(function() { 
    var destroy = $(this).text() === 'Remove'; 
    $(this).text(destroy ? 'Re-attach' : 'Remove'); 
    $('#defaultCountdown').countdown(destroy ? 'destroy' : {until: newYear}); 
});
</script>  