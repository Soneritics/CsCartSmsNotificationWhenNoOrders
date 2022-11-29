# CsCartSmsNotificationWhenNoOrders
CsCart Google Sitemap regenerate via a cron job

## Usage
Open the following URL:
 - https://domain/?dispatch=soneritics_noordernotification.action

Or use a cronjob, like this, to run this script every 5 minutes:

`
*/5 * * * * /usr/bin/wget -O /dev/null https://domain.com/index.php?dispatch=soneritics_noordernotification.action >/dev/null 2>&1
`

Of course, the plugin should first be installed and configured.
