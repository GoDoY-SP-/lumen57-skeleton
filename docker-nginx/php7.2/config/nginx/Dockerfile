FROM nginx:latest

# Propriedade
MAINTAINER Danilo D. de Godoy <danilo.doring@gmail.com>

# Instalar apps
RUN apt-get update \
	&& apt-get install -y  \
	vim \
	curl \
	wget

# Configurar hosts
RUN echo "127.0.0.1	${SRV_DNS_LUMEN57}" >> /etc/hosts \
    	&& echo "::1	${SRV_DNS_LUMEN57}" >> /etc/hosts

WORKDIR "/var/www/lumen57"