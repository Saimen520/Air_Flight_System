<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>Booking History</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f9;
                        margin: 0;
                        padding: 20px;
                    }
                    h1 {
                        text-align: center;
                        color: #333;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        background-color: #fff;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    th, td {
                        padding: 12px 15px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }
                    th {
                        background-color: #007bff;
                        color: #fff;
                        font-weight: bold;
                    }
                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                    tr:hover {
                        background-color: #e9ecef;
                    }
                    td {
                        color: #333;
                    }
                    @media (max-width: 768px) {
                        table {
                            font-size: 14px;
                        }
                        th, td {
                            padding: 8px 10px;
                        }
                    }
                </style>
            </head>
            <body>
                <h1>Booking History</h1>
                <table>
                    <tr>
                        <th>Flight ID</th>
                        <th>Customer Name</th>
                        <th>IC Number</th>
                        <th>Class</th>
                        <th>Price (RM)</th>
                        <th>Payment Amount (RM)</th>
                        <th>Booking Date</th>
                    </tr>
                    <xsl:for-each select="bookings/booking">
                        <tr>
                            <td><xsl:value-of select="flight_id"/></td>
                            <td><xsl:value-of select="customer_name"/></td>
                            <td><xsl:value-of select="identification_card"/></td>
                            <td><xsl:value-of select="class_type"/></td>
                            <td><xsl:value-of select="price"/></td>
                            <td><xsl:value-of select="payment_amount"/></td>
                            <td><xsl:value-of select="booking_date"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
