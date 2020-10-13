<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" id="xslt1">
<xsl:output doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd" method="html" indent="yes" encoding="ISO-8859-1" media-type="text/html"/>
<xsl:template match="/">

<html>
<head>
    <title>XSL</title>
    <style type="text/css">
       body{
           background-color: #41aea9;
           color: #e8ffff;
           text-align: center;
           padding-left: 10%;
           padding-right: 10%;
           position: relative;
       } 
       table{
           border: 1px solid #a6f6f1;
           padding: 1rem;
           margin: 1rem auto;
           width: 100%;
       }
       span{
           text-decoration: underline;
       }
       .lineafact{
           
           border-bottom: 1px solid #a6f6f1;
       }
       @media screen and (min-width: 900px){   
            body{
                padding-left: 25%;
                padding-right: 25%;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }
            
        }

    </style>
</head>
<body>
    <xsl:apply-templates select="/registro/factura"/>
</body>
</html>
</xsl:template>

<xsl:template match="factura">
 <table>
        <tr>
            <td>Factura No. <span> <xsl:value-of select="./num/text()"/></span></td>
            <td>Tipo: <xsl:value-of select="./@tipo"/></td>
        </tr>
        <tr>
            <td>Cliente:  </td>

        </tr>
        <tr>
            <td>Nombre:  <xsl:value-of select="./cliente/nombre/text()"/></td>
           
<td>Documento: <xsl:value-of select="name(./cliente/documento/dui |  ./cliente/documento/pasaporte)"/> :  <xsl:value-of select="./cliente/documento/dui/text()|  ./cliente/documento/pasaporte/text()"/></td>  
      
           
        </tr>
        <tr>
            <td>Telefono:  <xsl:value-of select="./cliente/telefono/text()"/></td>
            <td>Email:  <xsl:value-of select="./cliente/email/text()"/></td>
        </tr>


        <tr>
            <td class="lineafact">Codigo</td>
            <td class="lineafact">Detalle</td>
            <td class="lineafact">Cantidad</td>
            <td class="lineafact">Precio</td>
            <td class="lineafact">Subtotal</td>
        </tr>
        <tr>
            <td class="lineafact"><xsl:value-of select="./lineafactura/codigo/text()"/></td>
            <td class="lineafact"><xsl:value-of select="./lineafactura/detalle/text()"/></td>
            <td class="lineafact"><xsl:value-of select="./lineafactura/cantidad/text()"/></td>
            <td class="lineafact"><xsl:value-of select="./lineafactura/precio/moneda/text()"/><xsl:value-of select="./lineafactura/precio/valor/text()"/></td>
            <td class="lineafact"><xsl:value-of select="./lineafactura/subtotal/moneda/text()"/><xsl:value-of select="./lineafactura/subtotal/valor/text()"/></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><xsl:value-of select="./total/moneda/text()"/><xsl:value-of select="./total/valor/text()"/></td>
        </tr>
    </table>
</xsl:template>

</xsl:stylesheet>
