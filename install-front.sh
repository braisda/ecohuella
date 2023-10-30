#!/bin/sh
echo "\n	########## INICIANDO INSTALACIÓN FRONT 'ECOHUELLA' ##########"
echo "\nDescargando front 'ECOHUELLA'...\n"
git clone https://github.com/braisda/ecohuella.git
echo "\Transfiriendo archivos de frontend 'ECOHUELLA'...\n"
mv ecohuella/View /var/www/html
rm -rf ecohuella
echo "\nDescarga finalizada"
echo "\n"
echo " #######  #####   #####  #     # #     # ####### #       #           #    "
echo " #       #     # #     # #     # #     # #       #       #          # #   "
echo " #       #       #     # #     # #     # #       #       #         #   #  "
echo " #####   #       #     # ####### #     # #####   #       #        #     # "
echo " #       #       #     # #     # #     # #       #       #        ####### "
echo " #       #     # #     # #     # #     # #       #       #        #     # "
echo " #######  #####   #####  #     #  #####  ####### ####### #######  #     # "
echo "\n	########## INSTALACIÓN FINALIZADA  ##########"
echo "\nDebe modificar el archivo 'View/js/constants.js' estableciendo la dirección ip de su servidor"
echo "\nAcceda a la aplicación con su navegador desde: 'ip_servidor_front/View'"
echo "\n"
