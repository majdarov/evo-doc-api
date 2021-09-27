@echo off

echo.

if '%1' equ '' goto help_lbl
if '%1' equ 'stop' goto stop_lbl

@echo Start docker...
echo.
docker ps | @find /I "evo-doc-api_database_1" > nul
if %ERRORLEVEL%==0 @echo Docker was started... && goto startserver
docker-compose up -d
@echo.

@REM Starting all jobs
:startserver
@echo Start server...
echo.
symfony server:status | @find /I "Listening on https://127.0.0.1:8000" > nul
if %ERRORLEVEL%==0 goto exitscriptstart
@echo Starting server...
symfony server:start -d
@echo.
goto exitscriptstart

:help_lbl
@echo Need one parameter 'start' or 'stop'
exit /b

:exitscriptstart
echo.
@echo All jobs started!
exit /b

@REM Stopping all jobs
:stop_lbl
@echo Stop docker...
echo.
docker ps | @find /I "evo-doc-api_database_1" > nul
if %ERRORLEVEL%==1 goto stopserver
docker-compose stop

:stopserver
@echo Stop server...
echo.
symfony server:status | @find /I "Listening on https://127.0.0.1:8000" > nul
if %ERRORLEVEL%==1 (@echo Server not started... && goto exitscriptstop)
symfony server:stop

:exitscriptstop
echo.
@echo All jobs stoped!
exit /b
