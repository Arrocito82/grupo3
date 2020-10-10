<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

<xsl:template match="/"> 
      <html> 
      <head> 
        <title> 
           EJEMPLO DE TRANSFORMACION USANDO HTML 4 TRANSICIONAL con estilos HTML 
        </title>         
        </head> 
    <body bgcolor="brown" text="white"> 
         <xsl:apply-templates select="mensajes/mensaje" /> 
    </body> 
  </html>    
</xsl:template> 
<xsl:template match="mensaje"> 
<h1 align="center"> 
            <font face="Bookman old style" size="5"> 
               <xsl:value-of select="./text()"/> 
            </font> 
          </h1> 
</xsl:template> 
 
</xsl:stylesheet>