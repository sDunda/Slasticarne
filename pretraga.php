<?php
  error_reporting(E_ALL);

  include('funkcije.php');

  $dom = new DOMDocument();
  $dom->load('podaci.xml');

  $xp = new DOMXPath($dom); #inic Xpath procesora
  $upit = stvoriUpit();
  $rezultat = $xp->query($upit);

?>

<html lang="hr" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8"/>
    <title>Ponuda</title>
    <link rel="icon" type="image/jpg" href="logo.jpg" />
    <link rel="stylesheet" type="text/css" href="dizajn.css" />
  </head>
  <body>
    <header>
      <a href="index.html"><img id="slika" src="logo.jpg" alt="logo.jpg"/></a>
      <h1>Slastičarnice grada Zagreba</h1>
    </header>
    <nav>
      <ul>
        <li><a href="index.html">Početna stranica</a></li>
        <li><a href="obrazac.html">Pretraga</a></li>
        <li><a href="podaci.xml">Ponuda</a></li>
        <li><a href="http://www.fer.unizg.hr/predmet/or" target="_top">Otvoreno računarstvo</a></li>
        <li><a href="https://www.fer.unizg.hr" target="_blank">FER</a></li>

      </ul>
    </nav>
    <section>
      <h2>Popis slastičarnica grada Zagreba</h2>
        <table id="podaci">
          <tr>
              <th>NAZIV</th>
              <th>ADRESA</th>
              <th>TELEFON</th>
              <th>RADNO VRIJEME</th>
              <th>OCJENA</th>
              <th>FACEBOOK</th>
          </tr>

          <?php
            foreach($rezultat as $slasticarnica)
            {
          ?>
            <tr>
              <td>
                <?php echo vratiElement($slasticarnica, 'naziv')->nodeValue; ?>
              </td>
            </tr>
            <?php } ?>



        </table>
    </section>
   <footer>
     <p>© sDunda </p>
   </footer>
 </body>
</html>
