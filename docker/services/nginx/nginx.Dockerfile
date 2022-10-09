FROM nginx:1.20-alpine

ADD ./config/default.conf /etc/nginx/conf.d/