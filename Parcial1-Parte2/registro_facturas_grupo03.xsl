<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"> 
<xsl:output doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd" method="html" indent="yes" encoding="ISO-8859-1" media-type="text/html"/>

<xsl:template match="/">

<html>
<head>
    <title>XSL</title>
</head>
<body>
    <xsl:apply-templates select="/registro/factura"/>
</body>
</html>
</xsl:template>

<xsl:template match="factura">
 <table>
        <tr>
            <td>Factura No. <xsl:value-of select="./num/text()"/></td>
            <td>tipo: <xsl:value-of select="./@tipo/text()"/></td>
        </tr>
        <tr>
            <td>cliente: </td>

        </tr>
        <tr>
            <td>nombre:</td>
            <td>Documento:</td>
        </tr>
        <tr>
            <td>Telefono:</td>
            <td>Email:</td>
        </tr>


        <tr>
            <td>Codigo</td>
            <td>detalle</td>
            <td>cantidad</td>
            <td>precio</td>
            <td>subtotal</td>
        </tr>
        <tr>
            <td/>
            <td/>
            <td/>
            <td/>
            <td/>
        </tr>
        <tr>
            <td>Total</td>
            <td/>
        </tr>
    </table>
</xsl:template>
</xsl:stylesheet>
