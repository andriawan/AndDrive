<?php
/**
* 
* dd() if env not production
* 
*/
function debug_me($var)
{
  if(env('APP_ENV') == "production")
  {
    // no activities
  }else
  {
    var_dump($var);
  }
   
}