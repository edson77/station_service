<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td >
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="header">
                        <p>M/Mme {{$prenom}} {{$nom}},  Votre compte utilisateur vient d'être créé.</p>
                        <p>Nom d'utilisateur: {{$identifiant}}</p>
                        <p>Mot de passe: {{$password}}</p>
                    </td>
                </tr>
                <td>
                    <table class="footer" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td class="content-cell" align="center">
                                <b> © {{ date('Y') }} GED SED. @lang('Tous droits reservés.')</b>
                            </td>
                        </tr>
                    </table>
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>




