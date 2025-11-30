## for node-angel-one node sdk project run
node webhook-handler.js

## Run angel one websocket command
php artisan angelone:websocket


## Setup websocket
1.
sudo nano /etc/systemd/system/laravel-websocket.service
-----------------------------------------------
[Unit]
Description=Laravel WebSocket Command
After=network.target

[Service]
User=root
Group=root
WorkingDirectory=/var/www/html/ShivasAlgo
ExecStart=/usr/bin/php /var/www/html/ShivasAlgo/artisan angelone:websocket
Restart=always
RestartSec=10
StartLimitInterval=1h
StartLimitBurst=60
StandardOutput=syslog
StandardError=syslog

[Install]
WantedBy=multi-user.target


2.
sudo systemctl daemon-reload

3.
sudo systemctl enable laravel-websocket.service

4.
sudo systemctl status laravel-websocket.service

5.
sudo reboot

6.
sudo systemctl status laravel-websocket.service

7.
sudo crontab -e

# Start WebSocket service at 9:00 AM
0 9 * * 1-5 systemctl start laravel-websocket.service

# Stop WebSocket service at 3:30 PM
0 16 * * 1-5 systemctl stop laravel-websocket.service


# Monitor and Troubleshoot ::
sudo journalctl -u laravel-websocket.service


# Setup for any cronjob
* * * * * cd /var/www/html/ShivasAlgo && php artisan schedule:run >> /dev/null 2>&1