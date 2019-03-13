@echo off
REM Laravel package for phpsocket.io
REM 
REM @author    Aleksandr Efimov <sanches.com@mail.ru>
REM @copyright 2019 Aleksandr Efimov

if "%PHP_PEAR_PHP_BIN%" neq "" (
    set PHPBIN=%PHP_PEAR_PHP_BIN%
) else set PHPBIN=php

"%PHPBIN%" "%~dp0\socket" %*
