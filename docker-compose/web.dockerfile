FROM nginx:1.10-alpine
#instalamos la imagen 

ADD docker-compose/vhost.conf /etc/nginx/conf.d/default.conf
# archovo a maquina virtual

COPY public /var/www/public