<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:s="http://www.sitemaps.org/schemas/sitemap/0.9">

    <xsl:output method="html" indent="yes" encoding="UTF-8"/>

    <xsl:template match="/">
        <html lang="en">
            <head>
                <meta charset="UTF-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <title>Sitemap Index</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 24px; color: #222; }
                    h1 { margin-bottom: 8px; }
                    p { color: #555; }
                    table { border-collapse: collapse; width: 100%; margin-top: 16px; }
                    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
                    th { background: #f5f5f5; }
                    tr:nth-child(even) { background: #fafafa; }
                    a { color: #0b63ce; text-decoration: none; }
                    a:hover { text-decoration: underline; }
                </style>
            </head>
            <body>
                <h1>Sitemap Index</h1>
                <p>This is a list of child sitemaps for this website.</p>

                <table>
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="s:sitemapindex/s:sitemap">
                            <tr>
                                <td>
                                    <a href="{s:loc}">
                                        <xsl:value-of select="s:loc"/>
                                    </a>
                                </td>
                                <td>
                                    <xsl:value-of select="s:lastmod"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
