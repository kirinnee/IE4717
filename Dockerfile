FROM php:8-apache as base
RUN docker-php-ext-install mysqli
