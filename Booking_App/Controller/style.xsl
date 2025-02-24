<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <xsl:template match="/root">
        <html>
        <body>
            <img id="UserLogo" src="../../image/UserLogo.png" alt="Profile Logo"></img>
            <h2>User Profile</h2>
            <table border="1">
                <xsl:for-each select="item">
                    <tr>
                        <th>ID</th>
                        <td><xsl:value-of select="UserID"/></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><xsl:value-of select="Name"/></td>
                    </tr>
                    <tr>
                        <th>IDNumber</th>
                        <td><xsl:value-of select="IDNumber"/></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><xsl:value-of select="Address"/></td>
                    </tr>
                    <tr>
                        <th>Birthday Date</th>
                        <td><xsl:value-of select="BirthdayDate"/></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><xsl:value-of select="Age"/></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><xsl:value-of select="Email"/></td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td><xsl:value-of select="Role"/></td>
                    </tr>
                </xsl:for-each>
            </table>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
