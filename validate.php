<?php

  function isValid($state, $zip)
  {

    if(stateValid($state) && zipValid($zip))
    {
      return true;
    }
    return false;

  }

  function stateValid($state)
  {
    if(strlen(trim($state)) == 2)
    {
      return true;
    }
    return false;
  }

  function zipValid($zip)
  {
    if(strlen($zip) == 5 && (int)$zip > 0 && is_numeric($zip))
    {
      return true;
    }
    return false;
  }

?>
