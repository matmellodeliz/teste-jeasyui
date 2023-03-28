<?php
    session_unset();
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Login</h2>
    <p>Digite seu email e senha</p>
    
    <div class="easyui-panel" title="Credenciais" style="width:300px;padding:10px;">
        <form id="ff" action="login_check.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input name="email" class="f1 easyui-textbox" value="thiago@email.com"></input></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input name="senha" class="f1 easyui-passwordbox" value="123"></input></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Entrar"></input></td>
                </tr>
            </table>
        </form>
    </div>
    <style scoped>
        .f1{
            width:200px;
        }
    </style>
    <script type="text/javascript">
        
    </script>
</body>
</html>