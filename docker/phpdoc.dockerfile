FROM phpdoc/phpdoc
RUN apt-get update
RUN apt-get install -y libxslt-dev
RUN docker-php-ext-install xsl