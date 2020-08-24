FROM mysql:5.7
ENV MYSQL_DATABASE=test \
    MYSQL_ROOT_PASSWORD=root

ADD schema.sql /docker-entrypoint-initdb.d
