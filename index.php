<?php
// Probando GIT
//Segunda
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
<meta name='author' content='Prime'> 
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<link rel='stylesheet' href='reset.css?v=1'>
<link rel='stylesheet' href='style.css?v=2'>
<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:regular,bold,900'>
<script src='modernizr.js?v=1'></script>
</head>
<body id='tiny-php'>

<div id="main">

  
  <section>
    <div class='wrap'>

      <h1>Tiny PHP</h1>
      <ul id='tiny-rundown'> 
        <li>You must use PHP open/close tags</li> 
        <li>If PHP open/close tags are properly used, PHP can co-exist with HTML</li> 
        <li>Class and function names will not be altered</li> 
      </ul>

      <form method="post" id='tiny-form'>

        <input type="hidden" name="token" value="1">
        <div class='textarea-wrap'><textarea id='tiny-snippet' name='snippet'><?php if(!empty($_POST['snippet'])) echo htmlentities($_POST['snippet']); else echo 'Enter your code...'?></textarea></div>


        <?php if(!empty($tiny_snippet)):?>
        <div class='textarea-wrap'><textarea ><?php echo $tiny_snippet; ?></textarea></div>
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
<script src='action.js?v=1'></script>
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
 