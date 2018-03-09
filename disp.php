<?php
// Скрипт проверки
include 'config.php';
# Соединямся с БД
$link=mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base);

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {
        if(isset($_POST['submit']))
        {
        $err = array();

            if(count($err) == 0)
            {
                $user_id = $userdata['user_login'];
                $number_m = $_POST['number_m'];
                $tt_1 = $_POST['tt_1'];
                $tt_2 = $_POST['tt_2'];
                $tt_3 = $_POST['tt_3'];
                $tt_4 = $_POST['tt_4'];
                $tt_5 = $_POST['tt_5'];
                $tt_6 = $_POST['tt_6'];
                $tt_7 = $_POST['tt_7'];
                $tt_8 = $_POST['tt_8'];
                $tt_9 = $_POST['tt_9'];
                $tt_10 = $_POST['tt_10'];


                mysqli_query($link,"INSERT INTO trip SET data=STR_TO_DATE(now(), '%Y-%m-%d'),time=CURTIME(), number_m='".$number_m."', tt_1='".$tt_1."', tt_2='".$tt_2."', tt_3='".$tt_3."', tt_4='".$tt_4."', tt_5='".$tt_5."', tt_6='".$tt_6."', tt_7='".$tt_7."', tt_8='".$tt_8."', tt_9='".$tt_9."', tt_10='".$tt_10."', user_id='".$user_id."'");
                //echo $number_m.'   '.$tt_1.'   '.$tt_2.'   '.$tt_3.'   '.$tt_4.'   '.$tt_5.'   '.$tt_6.'   '.$tt_7.'   '.$tt_8.'   '.$tt_9.'     '.$user_id;
                header("Location: ok_disp.php"); exit();
                
            }
            else
            {
                print "ошибка";
                foreach($err AS $error)
                {
                    print $error."<br>";
                }
            }
        }
        
    }
}
else
{
    print "Включите куки";
}

include 'header.php';

?>


<form method="POST"><h4>
<p style="text-align: center;">Номер машины
<SELECT NAME="number_m">
    <OPTION value = "507">507
    <OPTION value = "512">512
    <OPTION value = "581">581
    <OPTION value = "584">584
    <OPTION value = "588">588
    <OPTION value = "604">604
    <OPTION value = "916">916
    <OPTION value = "921">921
    <OPTION value = "924">924
    <OPTION value = "Наемник">Наемник
    </OPTION>
</SELECT><br></p>
</br>
        <p style="text-align: center;">Номер 1 магазина
        <SELECT NAME="tt_1">
            <OPTION value = "--//--">--//--
            <OPTION value = "АГ-2">АГ-2
            <OPTION value = "АГ-3">АГ-3
            <OPTION value = "АГ-4">АГ-4
            <OPTION value = "АГ-6">АГ-6
            <OPTION value = "АГ-7">АГ-7
            <OPTION value = "АГ-8">АГ-8
            <OPTION value = "АГ-10">АГ-10
            <OPTION value = "АГ-13">АГ-13
            <OPTION value = "АГ-14">АГ-14
            <OPTION value = "АГ-15">АГ-15
            <OPTION value = "АГ-16">АГ-16
            <OPTION value = "АГ-18">АГ-18
            <OPTION value = "АГ-19">АГ-19
            <OPTION value = "АГ-20">АГ-20
            <OPTION value = "АГ-21">АГ-21
            <OPTION value = "АГ-24">АГ-24
            <OPTION value = "АГ-28">АГ-28
            <OPTION value = "АГ-29">АГ-29
            <OPTION value = "АГ-30">АГ-30
            <OPTION value = "АГ-31">АГ-31
            <OPTION value = "АГ-34">АГ-34
            <OPTION value = "АГ-35">АГ-35
            <OPTION value = "АГ-38">АГ-38
            <OPTION value = "АГ-43">АГ-43
            <OPTION value = "АГ-46">АГ-46
            <OPTION value = "АГ-48">АГ-48
            <OPTION value = "АУ-1">АУ-1
            <OPTION value = "АУ-2">АУ-2
            <OPTION value = "АУ-3">АУ-3
            <OPTION value = "АУ-5">АУ-5
            <OPTION value = "АУ-6">АУ-6
            <OPTION value = "АУ-7">АУ-7
            <OPTION value = "АУ-8">АУ-8
            <OPTION value = "АУ-9">АУ-9
            <OPTION value = "АУ-11">АУ-11
            <OPTION value = "АУ-14">АУ-14
            </OPTION>
        </SELECT><br></p>

        <p style="text-align: center;">Тип магазина
            <SELECT NAME="tip_tt">
                <OPTION value = "Сетка">Сетка
                <OPTION value= "Паллет">Паллет
                <OPTION value = "Термо Большой">Термо большой
                <OPTION value= "Термо Маленький">Термо маленький
                </OPTION>
            </SELECT><br></p>
        </br>

        <p style="text-align: center;">Номер 2 магазина
            <SELECT NAME="tt_2">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 3 магазина
            <SELECT NAME="tt_3">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 4 магазина
            <SELECT NAME="tt_4">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 5 магазина
            <SELECT NAME="tt_5">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 6 магазина
            <SELECT NAME="tt_6">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 7 магазина
            <SELECT NAME="tt_7">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 8 магазина
            <SELECT NAME="tt_8">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 9 магазина
            <SELECT NAME="tt_9">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

        <p style="text-align: center;">Номер 10 магазина
            <SELECT NAME="tt_10">
                <OPTION value = "--//--">--//--
                <OPTION value = "АГ-2">АГ-2
                <OPTION value = "АГ-3">АГ-3
                <OPTION value = "АГ-4">АГ-4
                <OPTION value = "АГ-6">АГ-6
                <OPTION value = "АГ-7">АГ-7
                <OPTION value = "АГ-8">АГ-8
                <OPTION value = "АГ-10">АГ-10
                <OPTION value = "АГ-13">АГ-13
                <OPTION value = "АГ-14">АГ-14
                <OPTION value = "АГ-15">АГ-15
                <OPTION value = "АГ-16">АГ-16
                <OPTION value = "АГ-18">АГ-18
                <OPTION value = "АГ-19">АГ-19
                <OPTION value = "АГ-20">АГ-20
                <OPTION value = "АГ-21">АГ-21
                <OPTION value = "АГ-24">АГ-24
                <OPTION value = "АГ-28">АГ-28
                <OPTION value = "АГ-29">АГ-29
                <OPTION value = "АГ-30">АГ-30
                <OPTION value = "АГ-31">АГ-31
                <OPTION value = "АГ-34">АГ-34
                <OPTION value = "АГ-35">АГ-35
                <OPTION value = "АГ-38">АГ-38
                <OPTION value = "АГ-43">АГ-43
                <OPTION value = "АГ-46">АГ-46
                <OPTION value = "АГ-48">АГ-48
                <OPTION value = "АУ-1">АУ-1
                <OPTION value = "АУ-2">АУ-2
                <OPTION value = "АУ-3">АУ-3
                <OPTION value = "АУ-5">АУ-5
                <OPTION value = "АУ-6">АУ-6
                <OPTION value = "АУ-7">АУ-7
                <OPTION value = "АУ-8">АУ-8
                <OPTION value = "АУ-9">АУ-9
                <OPTION value = "АУ-11">АУ-11
                <OPTION value = "АУ-14">АУ-14
                </OPTION>
            </SELECT><br></p>

</br>
</br>
<p style="text-align: center;">
    <input name="submit" type="submit" value="Отправить" class="btn btn-success">&nbsp;&nbsp;&nbsp;
    <input name="Очистить" type="reset" value="   Очистить   " class="btn btn-warning"/>
</p>
    </h4>
</form>

<?php
include 'footer.php';
?>