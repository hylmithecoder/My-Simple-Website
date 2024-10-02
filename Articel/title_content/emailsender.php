<?php
$to = 'hylmimuhammadfiarymahdi@gmail.com';
$subject = 'Ini Dari Server';
$message = 'Hello world my first send an email';
$header = "From: eslemonnn09@gmail.com\r\n";
if (mail($to, $subject, $message, $header))
{
    echo "<script>console.log('Berhasil Mengirim Email ke $to')</script>";
}
else
{
    echo "<script>console.log('Gagal Mengirim Email ke $to')</script>";
}
?>