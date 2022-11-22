cd C:\xampp\mysql\bin
echo off
mysqldump -hlocalhost -uroot -p skills > C:\copia_seguridad_%Date:~6,4%%Date:~3,2%%Date:~0,2%_.sql
exit