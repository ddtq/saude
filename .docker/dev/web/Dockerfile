FROM httpd:2.4.41-alpine
RUN apk update; \
    apk upgrade;
RUN apk add \
  bash \
  apache2 \
  apache2-utils \
  php7-apache2 \
  curl \
  ca-certificates \
  openssl \
  git \
  tzdata \
  openntpd;

RUN sed -i "s/#LoadModule\ rewrite_module/LoadModule\ rewrite_module/" /usr/local/apache2/conf/httpd.conf;
# Copy apache vhost file to proxy php requests to php-fpm container
COPY .htaccess /usr/local/apache2/htdocs/.htaccess
COPY saude.vhost.conf /usr/local/apache2/conf/saude.vhost.conf

RUN echo "Include /usr/local/apache2/conf/saude.vhost.conf" \
    >> /usr/local/apache2/conf/httpd.conf