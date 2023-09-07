### To use CRON, uncomment everything and change the command on line 3.
# echo "#initiating cron" > /meus.log
# echo "* * * * * cd /var/www/html/ && php artisan schedule:run >> /meus.log  2>&1" > /etc/cron.d/schedule
# chmod 0644 /etc/cron.d/schedule
# crontab /etc/cron.d/schedule
# cron
