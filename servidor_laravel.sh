#!/bin/bash
gnome-terminal --tab -e "bash -c 'npm run dev; bash'" \
               --tab -e "bash -c 'php artisan serve; bash'" \
               --tab -e "bash -c 'psql -h localhost -U abelsm -d clinica_dental_guadalquivir; bash'" \
               --tab -e "bash -c 'code .; bash'"
