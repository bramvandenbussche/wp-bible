<?php

require_once( ABSPATH . "wp-includes/class-snoopy.php");

function matej_register ($what, $version){
  $register = "http://matej.nastran.net/register.php?what=$what&update=1&version=$version&url=".base64_encode(get_bloginfo('url'))."&name=".base64_encode(get_bloginfo('name'));
  $my_name = $what."_plugin_registered";
  $is_registered = get_option($my_name) == true;
  $snoopy = new Snoopy();
  if (!$is_registered)
  {
      $result = $snoopy->fetch($register);
      if($result) if ($snoopy->results == "OK")
            update_option($my_name, true);
  }

}

function matej_update ($what, $title, $version)
{
  $snoopy = new Snoopy();
  $update_url = "http://matej.nastran.net/register.php?what=$what&update=1";
  $result = $snoopy->fetch($update_url);
  $plugin_url = "http://matej.nastran.net/tag/plugin/";
  if($result){
      $last_version = $snoopy->results;
      if ($last_version > $version)
         $update_text = "<b><font color=\"red\">A newer version of plugin exists. Goto <a title=\"$title $last_version\" href=\"$plugin_url\">$plugin_url</a> to install it!</font></b>";
      else
         $update_text = "Congratulations, you have the latest version!";
  }
  else{
      $last_version = "<b>Unknown!</b>";
      $update_text = "Visit <a href=\"$plugin_url\">plugin homepage</a>, to see if you have the latest version.";
  }
  $info_url = "http://matej.nastran.net/register.php?info=1";
  $result = $snoopy->fetch($info_url);
  if($result)
      $info = $snoopy->results;
  else
  	 $info = "";
  	?>
    	   <div class="wrap">
        	<h2>Updates</h2>
            <?php echo $title; ?> is installed and active. <br/><br/>
            Your version: <?php echo $version; ?><br/> 
            Latest version: <?php echo $last_version; ?><br/><br/>
            <?php
                 echo $update_text;
            ?>
        </div>
        <div class="wrap">
        	   <?php echo $info; ?>
        </div>
    <?php
}

?>