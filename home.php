<?php

// Страница авторизации
include 'config.php';
# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Соединямся с БД
$link=mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base);

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    # Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!@$_POST['not_attach_ip'])
        {
            # Если пользователя выбрал привязку к IP
            # Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        # Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        # Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);

        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: disp.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
include 'header.php';
?>

<form method="post"><h4>
<p style="text-align: center;">Логин &nbsp; &nbsp;&nbsp;
    
    <input  maxlength="18" name="login" type="text" size="20" />
    
</p>
<p style="text-align: center;">Пароль &nbsp;
    
    <input  maxlength="18" name="password" type="password" size="20" />
    
</p>
<p style="text-align: center;">&nbsp;
    
      
   
    
    
    
    <input  name="submit" type="submit" value="  Отправить   " class="btn btn-success"/>&nbsp;&nbsp;&nbsp;
    <input  name="Очистить" type="reset" value="   Очистить   " class="btn btn-warning"/>
    
</p></h4>
</form>


<?php
include 'footer.php';
?>


