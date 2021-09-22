@echo off

echo Start...
echo.

if '%1' equ '' goto help_lbl
if '%1' equ 'stop' goto stop_lbl

@echo Start docker...
echo.
docker ps | @findstr /I "evo-doc-api_database_1" > nul
if %ERRORLEVEL%==0 goto startserver
docker-compose up -d

:startserver
@echo Start server...
echo.
symfony server:status | @findstr /I "Listening on https://127.0.0.1:8000" > nul
if %ERRORLEVEL%==0 goto exitscriptstart
symfony server:start -d
goto exitscriptstart

:help_lbl
@echo Need one parameter 'start' or 'stop'
exit /b

:exitscriptstart
echo.
@echo All jobs started!
exit /b

:stop_lbl
@echo Stop docker...
echo.
docker ps | @findstr /I "evo-doc-api_database_1" > nul
if %ERRORLEVEL%==1 goto stopserver
docker-compose stop

:stopserver
@echo Stop server...
echo.
symfony server:status | @findstr /I "Listening on https://127.0.0.1:8000" > nul
if %ERRORLEVEL%==1 goto exitscriptstop
symfony server:stop

:exitscriptstop
echo.
@echo All jobs stoped!
exit /b
