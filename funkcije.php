<?php

  function stvoriUpit(){
    $query = array();

    if (isset($_REQUEST['ime'])){
      $query[] = 'contains(' . pretvori('naziv') . ', "' . mb_strtoupper($_REQUEST['ime'], "UTF-8") . '")'; #contains(ime, "AM"), ali svako ime koje usporeduje poveca slova.
    }

    if (isset($_REQUEST['vlasnik'])){
      $query[] = 'contains(' . pretvori('vlasnik') . ', "' . mb_strtoupper($_REQUEST['vlasnik'], "UTF-8") . '")';
    }

    $adresa = array();

    if (isset($_REQUEST['ulica'])){
      $adresa[] = 'contains(' . pretvori('ulica') . ', "' . mb_strtoupper($_REQUEST['ulica'], "UTF-8") . '")';
    }

    if (isset($_REQUEST['broj'])){
      $adresa[] = 'kucni_broj= "' . $_REQUEST['broj'] . '"';
    }

    if (isset($_REQUEST['kvart'])){
      $adresa[] = 'contains(' . pretvori('kvart') . ', "' . mb_strtoupper($_REQUEST['kvart'], "UTF-8") . '")';
    }

    if (isset($adresa)){
      $query[] = 'adresa[' . implode(' and ', $adresa) . ']';
      # $adresa = ['prvi', 'drugi', 'treci']
      # implode(' and ', $adresa) = 'prvi and drugi and treci'
    }

    $radno_vrijeme = array();

    if (isset($_REQUEST['vrijeme'])){
      $radno_vrijeme[] = '' . $_REQUEST['vrijeme'] . '>= od and' . $_REQUEST['vrijeme'] . '< do';
      # $nesto = 'blabla'
      # '' . $nesto = 'blabla'
    }

    if (isset($_REQUEST['dan'])){
      $dan_u_tjednu = array();

      foreach($_REQUEST['dan'] as $dan){
        $dan_u_tjednu[] = '@dan="' . $dan . '"';
        # $_REQUEST['dan'] = ['radni_dan', 'vikend']
        # u prvoj iteraciji $dan = 'radni_dan', u drugoj iteraciji $dan = 'vikend'
      }

      if (isset($dan_u_tjednu)){
        $radno_vrijeme[] = '(' . implode(' and ', $dan_u_tjednu) . ')';
      }
    }

    if (isset($radno_vrijeme)){
      $query[] = 'radno_vrijeme[' . implode(' and ', $radno_vrijeme) . ']';
    }

    if (isset($_REQUEST['ocjena'])){
      $query[] = 'ocjena="' . $_REQUEST['ocjena'] . '"';
    }

    if (isset($_REQUEST['gluten'])){
      $query[] = '@GlutenFREE="' . $_REQUEST['gluten'] . '"';
    }


    $finalQuery = implode(' and ', $query);

    if(!empty($finalQuery)){
      return '/slasticarnice/slasticarnica[' . $finalQuery . ']';
    }
    else
    {
      return '/slasticarnice/slasticarnica';
    }
  }

  function pretvori($string)
  {
    return "translate(" . $string . ", 'abcdefghijklmnopqrstuvwxyzčćžđš', 'ABCDEFGHIJKLMNOPQRSTUVWXYZČĆŽĐŠ')";
  }

  function vratiElement($node, $elementName)
  {
    return $node->getElementsByTagName($elementName)->item(0);
  }
?>
