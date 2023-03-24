<?php
if(isset($_POST['submit']))
{
    if(!empty($_POST['Fname']) AND !empty($_POST['email']) AND !empty($_POST['Lname']))
    {
        // Set SMTP settings for Gmail
        ini_set("SMTP","smtp.gmail.com");
        ini_set("smtp_port","587");
        ini_set("sendmail_from","hfc.street.search@gmail.com");
        ini_set("auth_username","hfc.street.search@gmail.com");
        ini_set("auth_password","Street.se@rch00");
        ini_set("starttls","true");


        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Street Search"<hfc.street.search@gmail.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';

        $message='
        <html>
            <body>
                <div align="center">
                    <u>Nom de l\'expéditeur :</ul>'.$_POST['Fname'].'<br/>
                    <u>Mail de l\'expéditeur :</ul>'.$_POST['email'].'<br/>
                    <u>Age de l\'expéditeur :</ul>'.$_POST['Lname'].'<br/>
                    <br>
                </div>
            </body>
        </html>
        ';

        mail("hfc.street.search@gmail.com", "CONTACT - street-search.com", $message, $header);
        $msg="Votre message a bien été envoyé !";
    }
    else
    {
        $msg="Tous les champs doivent être complétés !";
    }
}
?>