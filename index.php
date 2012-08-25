<?php
ini_set('display_errors',TRUE);
include_once('tinyphp.class.php');
$tinyphp = new tinyPhp;
$php_excludes = $tinyphp->php_excludes;
if(!empty($_POST['snippet'])) {
  if(!empty($_POST['replace_variables'])) {
    $replace_variables = TRUE;
  } else {
    $replace_variables = FALSE;
  }
  if(!empty($_POST['remove_whitespace'])) {
    $remove_whitespace = TRUE;
  } else {
    $remove_whitespace = FALSE;
  }
  if(!empty($_POST['remove_comments'])) {
    $remove_comments = TRUE;
  } else {
    $remove_comments = FALSE;
  }
  if(!empty($_POST['additional_excludes'])) {
    $excludes_string = preg_replace(array('/\s{1,}/','/[\t\n]/'),'',$_POST['additional_excludes']);
    $excludes_array = explode(',',$excludes_string);
  }
  if(empty($excludes_array) || !is_array($excludes_array)) {
    $excludes_array = array();
  }
  $tiny_snippet = $tinyphp->get_tiny($_POST['snippet'],
  $replace_variables,
  $remove_whitespace,
  $remove_comments,
  $excludes_array);
}
?>

<!DOCTYPE html>
<html id='labs' class='darkHead'>
<head>
<title>Tiny PHP :: prime labs</title>
<meta name="Description" content="" />
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://builtbyprime.com/img/logo.png" />
<meta name='author' content='Prime'> 
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<link rel='shortcut icon' href='http://builtbyprime.com/favicon.ico?v=1'> 
<link rel='stylesheet' href='http://builtbyprime.com/css/reset.css?v=1'>
<link rel='stylesheet' href='http://builtbyprime.com/css/style.css?v=2'>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:regular,bold,900'>
<script src='http://builtbyprime.com/js/modernizr.js?v=1'></script>
</head>
<body id='tiny-php'>

<header>
  <div class='wrap'>
    <a href='/' id='logo'>prime</a>
    <nav>
      <ul class='clearfix'>
        <li><a href='http://builtbyprime.com' id='aboutTrigger'>about</a></li>
        <li><a href='http://blog.builtbyprime.com'>blog</a></li>
        <li><a href='#' id='contactTrigger'>contact</a></li>
      </ul>
      <div id='social'>
        <a href='tel:+1-248-662-5668' id='phone'><h5>(248) 767-2948</h5></a>
        <a href='//fb.me/primestudios' id='facebook'>facebook</a>
        <a href='//twitter.com/primestudios' id='twitter'>B</a>
      </div>
    </nav>
    <form id='contact-form'>
      <h3>contact</h3>
      <div class='input-wrap'><input type='text' id='email' placeholder='email address' /></div>
      <div class='textarea-wrap'><textarea id='message' placeholder='message'></textarea></div>
      <input type='submit' value='submit' /> or <a href='#'>cancel</a>
    </form>
  </div>
</header>

<div id="main">

  
  <section>
    <div class='wrap'>

      <h1>Tiny PHP</h1>
      <p>This is a tool you can use to condense your PHP code. While there are no real performance benefits to PHP with a smaller footprint, you may want to use one-liner methods, or obfuscate the code for a specific reason.</p>

      <p>Here is the rundown:</p> 
      <ul id='tiny-rundown'> 
        <li>You must use PHP open/close tags</li> 
        <li>If PHP open/close tags are properly used, PHP can co-exist with HTML</li> 
        <li>Class and function names will not be altered</li> 
      </ul>

      <form method="post" id='tiny-form'>

        <input type="hidden" name="token" value="1">
        <div class='textarea-wrap'><textarea id='tiny-snippet' name='snippet'><?php if(!empty($_POST['snippet'])) echo htmlentities($_POST['snippet']); else echo 'Enter your code...'?></textarea></div>


        <?php if(!empty($tiny_snippet)):?>
        <div class='textarea-wrap'><textarea><?php echo $tiny_snippet; ?></textarea></div>
        <?php endif;?>


        <h3>Excludes <em>ex. $flickr, $this, $object</em></h3>
        <div class='input-wrap'><input type="text" name="additional_excludes" value="<?php if(!empty($_POST['additional_excludes'])) echo htmlentities($_POST['additional_excludes']);?>"></div>


        <h3><br>Default Excludes</h3>

        <ul class='inline-list'>
          <?php foreach($php_excludes as $php_exclude) {echo '<li class="inline">'.$php_exclude.'</li>';}?>
        </ul>

        <br><br>

        <h3>Options</h3>

        <input type="checkbox" name="replace_variables"
        <?php
          if(isset($_POST['replace_variables']) || !isset($_POST['token'])) 
            echo 'checked';
          else
            echo '';
        ?>>
        <label for='replace_variables'>Replace Variables</label>

        <input type="checkbox" name="remove_whitespace"
        <?php
          if(isset($_POST['remove_whitespace']) || !isset($_POST['token'])) 
            echo 'checked';
          else
            echo '';
        ?>>
        <label for='remove_whitespace'>Remove Whitespace</label>

        <input type="checkbox" name="remove_comments"
        <?php
          if(isset($_POST['remove_comments']) || !isset($_POST['token'])) 
            echo 'checked';
          else
            echo '';
        ?>>
        <label for='remove_comments'>Remove Comments</label>
        
        <br><br><br><br>

        <input class='button' type="submit" value="Go Baby Go"><a class="reset" href="">Reset</a>

      </form>

    </div>
  </section>


</div>

<footer>
  <div class='wrap'>
    <div id='copy'>&copy; 2011</div>
    <div id='html5'></div>
  </div>
</footer>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js'></script> 
<script src='http://builtbyprime.com/js/action.js?v=1'></script>
<script>
(function(d) {
  var textarea = d.getElementById('tiny-snippet');
  textarea.onfocus = function(e) {
    this.value = ( this.value === 'Enter your code...' ) ? '' : this.value;
    textarea.style.color = '#454545';
    this.onblur = function(e) {
      this.value = ( this.value === '' ) ? 'Enter your code...' : this.value;
    }
  }
  d.getElementById('tiny-form').onsubmit = function(e) {
    if ( textarea.value === 'Enter your code...' ) {
      e.preventDefault();
      textarea.style.color = 'red';
    }
  }
}(document));
</script>
 