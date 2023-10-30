#!/bin/sh
echo "\n	########## INICIANDO INSTALACIÓN BACK 'ECOHUELLA' ##########"
echo "\nDescargando backend 'ECOHUELLA'...\n"
git clone https://github.com/braisda/ecohuella.git
echo "\Transfiriendo archivos de backend 'ECOHUELLA'...\n"
mv ecohuella/Backend /var/www/html
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
echo "\nDebe modificar el archivo 'Backend/Core/config.php' estableciendo la dirección ip de su servidor de back"
echo "\nDebe ejecutar el script SQL 'Backend/Core/carbono.sql' para ejecutar la aplicación"
echo "\nDebe ejecutar el script SQL 'Backend/Core/carbonoTest.sql' para ejecutar los test"
echo "\nAcceda a la aplicación con su navegador desde: 'ip_servidor_front/View'"
echo "\n"
