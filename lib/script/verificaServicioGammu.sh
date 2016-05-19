#!/bin/bash/SMS.YML

# Verificacion del archivo sms.yml, para verificar si se corre el script
cd ..
cd ..
cd config/
ruta=`find -iname sms.yml`
VALOR=`head -1 $ruta | grep "true" | wc -l`
# Valido si es TRUE
if [ $VALOR != 0 ]; then 
USB=`ls  /dev/ttyUSB0 | wc -l`
# Tomo decisiones dependiendo
if [ $USB != 0 ]; then
  echo "Esta activo USB0"; 
# Modifico los archivos de configuracion  por ttyUSB0 siempre
  sed -i 's/ttyUSB1/ttyUSB0/g' /root/.gammurc
  sed -i 's/ttyUSB1/ttyUSB0/g' /etc/gammu-smsdrc
# Reinicio servicios
  /etc/init.d/gammu-smsd stop
  /etc/init.d/gammu-smsd start
else
# Modifico los archivos de configuracion  por ttyUSB1 siempre
  sed -i 's/ttyUSB0/ttyUSB1/g' /root/.gammurc
  sed -i 's/ttyUSB0/ttyUSB1/g' /etc/gammu-smsdrc
# Reinicio servicios
  /etc/init.d/gammu-smsd stop
  /etc/init.d/gammu-smsd start
fi
fi
# Error opening device Este Error no como manejarlo --> No es muy comun
#CRON 2 NECESARIO 
#*/50 * * * * tail -1 /home/lyon/smslog.log | grep Terminating &&  sh /var/www/siglas-kernel/lib/script/verificaServicioGammu.sh &&  echo "El servicio SMS del SIGLAS-%%siglas institucion%% se encuentra activo" | gammu-smsd-inject TEXT 04265119193 -len 400
#*/45 * * * * tail -6 /home/lyon/smslog.log | grep Error &&  sh /var/www/siglas-kernel/lib/script/verificaServicioGammu.sh &&  echo "El servicio SMS del SIGLAS-%%siglas institucion%% se encuentra activo" | gammu-smsd-inject TEXT 04265119193 -len 400

# EL ENVIO DE SMS EN ESTE CRON COLOCARLO A NIVEL DE TASK PERMITIENDO CAPTURAR GRAFICAMENTE UN NUMERO DE TELEFONO
# Y CONFIGURAR DE FORMA GRAFICA SI QUIERE QUE SE LE DEN NOTIFICACIONES POR SMS DE ACTIVACION DEL SERVICIO
# ASI COMO EL MENSAJE "Se levanto el servicio gammu fundacit" POR "El servicio SMS del SIGLAS-%%siglas institucion%% se encuentra activo."
# EL NOMBRE DE LA INSTITUCION SE ENCUENTRA EN /config/siglas/datos_basicos.yml

# DE SER POSIBLE GENERAR AUTOMATICAMENTE ESTE SCRIT REARMADO POR PARAMETROS QUE SE CONFIGUREN DE FORMA GRAFICA """"DE SOLO LOS MODEN ACTIVOS""""
#    - NOMBRE DEL MODEN QUE SE CAPTURA DE LA CONFIG DE GAMMU DEL DEMONIO (linea 10 echo "Esta activo USB0";)
#    - PUERTO TTY QUE ESTA USANDO (lineas 7,12,13,19,20 ttyUSB0, ttyUSB1, etc)

# ?SI TENGO 1000 MENSAJES EN COLA AL HACER EL gammu-smsd-inject INSERTARIA EL REGISTRO EN LA POSICION 1001 
# Y NO LLEGARIA EL MENSAJE AL INSTANTE PORQUE TENDRIA QUE ESPERAR A QUE ENVIE LOS OTROS 1000

