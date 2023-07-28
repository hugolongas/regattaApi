<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .header{
            padding: 20px;
            text-align: center; 
            background:#cecece;     
        }
        .main{            
            max-width: 600px;
            text-align: center;
            margin:20px auto;
        }
        .footer{
            width: 100%;
            text-align: center;
            background-color: black;
            color:white;
            font-size:20px;
            padding:10px 0px 10px 0px;
        }
    </style> 
</head>
<body>     
    <div class="header">
        <a style="display: block;width: 220px;margin: 0 auto;" target="_blank">
            <img style="width: 150px;margin: 0 auto;" src="{{ asset('img/logo.png') }}">
        </a>
    </div>
    <div class="main">  
       <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" >
        <tr>
            <td align="center" valign="top">Verificació en dos pasos</td>        
            <td align="center" valign="top">
                <a class="btn" href="{{$url}}">Validar Usuari</a>
                </td>
        </tr>
        </tr>
       </table>
    </div>
    <div class="footer">
        Ateneu l'Aliança 2023
    </div>
</body>
</html>