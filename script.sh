#!/bin/bash
(crontab -l | grep -v "ree /Applications/MAMP/htdocs/Demandium-Admin/artisan email:free-trial-end-mail") | crontab -
(crontab -l; echo "0 0 * * * ree /Applications/MAMP/htdocs/Demandium-Admin/artisan email:free-trial-end-mail") | crontab -
