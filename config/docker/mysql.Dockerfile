FROM mariadb:10.5.8

WORKDIR /etc/mysql/conf.d

COPY config/docker/config/mysql/docker.my.cnf .

RUN mv docker.my.cnf my.cnf && chown -R mysql:mysql /var/log/mysql && touch /var/log/mysql/mysql_error.log && touch /var/log/mysql/mysql_slow.log

EXPOSE 3306