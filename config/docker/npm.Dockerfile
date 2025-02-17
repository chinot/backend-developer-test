FROM node:14.15.4-alpine

RUN apk update && apk upgrade && apk add git python

WORKDIR /var/www/html

COPY . .

ENTRYPOINT [ "npm" ]