<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
     <xsl:output method="xml" indent="yes" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"/>
<xsl:template match="/">
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
        <xsl:for-each select="slasticarnice/slasticarnica">
          <xsl:sort select="naziv"/>
          <tr>
            <td><xsl:value-of select="naziv"/></td>
            <td>
              <xsl:for-each select="adresa">
                <xsl:value-of select="ulica"/>&#160;<xsl:value-of select="kucni_broj"/><xsl:if test="position()!=last()">,</xsl:if><br/>
              </xsl:for-each>
              </td>
            <td>
              <xsl:for-each select="telefon">
                <xsl:value-of select="broj/@pozivni_broj"/>/<xsl:value-of select="broj"/><br/>
              </xsl:for-each>
            </td>
            <td>
                Radni dan
                <br/>
                <xsl:value-of select="radno_vrijeme[@dan='radni_dan']/od"/> - <xsl:value-of select="radno_vrijeme[@dan='radni_dan']/do"/>
                <br/>
                Vikendom
                <br/>
                <xsl:value-of select="radno_vrijeme[@dan='vikend']/od"/> - <xsl:value-of select="radno_vrijeme[@dan='vikend']/do"/>
                <br/>
            </td>
               <xsl:choose>
                <xsl:when test="ocjena">
                <td>
                  <xsl:value-of select="ocjena"/>
                </td>
                </xsl:when>
                <xsl:otherwise>
                        <td>*</td>
                </xsl:otherwise>
           </xsl:choose>
              <td>
                 <a href="http://www.facebook.com/{facebook_id}" target="_blank"> <img src="fblogo.png" id="fblogo" alt="fblogo"/></a>
              </td>


          </tr>
        </xsl:for-each>
          </table>
      </section>
     <footer>
       <p>© sDunda </p>
     </footer>
   </body>
 </html>
</xsl:template>

</xsl:stylesheet>
