<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP HomeWork #7</title>
</head>
<body>
    
    <form method="post">
        <input type="text" name="login" placeholder="Name" >
        <input type="text" name="password" placeholder="Password" >
        <button type="submit">Вход</button>
    </form>

    <?php

    function auth($iniArr, $loginHash, $passwordHash){
    $response = [];
    foreach($iniArr as $k => $v){
                if($k == 'login'){
                    if(password_verify($v, $loginHash)){
                        $response[] = 1;
                    }else{
                        continue;
                    }
                } elseif($k == 'password'){
                    if(password_verify($v, $passwordHash)){
                        $response[] = 1;
                    }else{
                        continue;
                    }
                }
            }
        if($response && count($response) > 1){
            return 1;
        }   

        return 0;
    }

    if($_POST){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $loginHash = password_hash("$login", PASSWORD_DEFAULT);
        $passwordHash = password_hash("$password", PASSWORD_DEFAULT);
        $iniArr = parse_ini_file('./config.ini');
        if(auth($iniArr, $loginHash, $passwordHash)){
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;
            setcookie('auth', 'ok', time() + 1800);
            echo "Вы авторизированны!";
            header("Location: /explorer.php");
        }
        

    }

    ?>

</body>
</html>