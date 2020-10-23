cd C:\xampp\mysql\bin
echo off
mysqldump -hlocalhost -uroot -p skills > E:\copia_seguridad_%date:~5,2%-%date:~8,2%-%date:~11,4%_%time:~0,2%h%time:~3,2%m.sql
exit