<!DOCTYPE html>

<html>

<head>
    <meta charset = 'utf-8' />
    <title>Giriş Yap</title>
    <link href="css/nav.css" rel="stylesheet">
    <style type="text/css">
    body {margin:1; padding:0;}
        #giris_formu {padding: 10px; width: 500px; margin: 50px auto; background: #ddd; border-radius: 5px;}
        input {padding: 10px; border: 1px solid #ccc; border-radius: 3px;}
        #button {background-color: #fa3636; cursor: pointer; color: #fff}
    </style>
    
</head>

<body bgcolor="lightslategray">
    <a href="anasayfa.php"><img src="resim/logo.png" align="left" width="195" height="105" alt="Web Sitesi Logosu" /></a>

    <nav>
        <ul class="navigasyon">
            <li>
                <a href="anasayfa.php">ANASAYFA</a>
            </li>
            <li><a href="etic/urunler.php">ÜRÜNLER</a>
            </li>
            <li>
                <a href="hayvan_bilgi.php">HAYVAN BİLGİ</a>
            </li>
            <li>
                <a href="hayvan_alim.php">CANLI HAYVAN ALIM</a>
            </li>
            <li>
                <a href="etic/hayvan_satim.php">CANLI HAYVAN SATIM</a>
            </li>
            <li>
                <a href="hakkimizda.php">HAKKIMIZDA</a>
            </li>
            <li>
                <a href="iletisim.php">İLETİŞİM</a>
            </li>
            <li>
                <a href="kayit.php">KAYIT OL</a>
            </li>
            <li>
                <a href="#">GİRİŞ YAP</a>
            </li>
        </ul>
    </nav>
    
    
    <br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="resim/giris.png">
    
    
    <div id="giris_formu">
    
    <form action="giris.php" method="POST">
    
    <table>
        
        <tr>
        <td>Kullanıcı Adı :</td><td> <input type="text" name="kullanici_adi"> </td>
        </tr>
        
        <tr>
        <td>Şifre:</td><td> <input type="password" name="sifre"> </td>
        </tr>
        
        <tr>
        <td></td><td> <input type="submit" id="button" value="Giriş Yap" > </td>
        </tr>
    </table>
</form>
    
    </div>
    
</body>
    

</html>


<?php

error_reporting(0);
session_start();

$db = new PDO("mysql:host=localhost;dbname=bizim_ciftlik;charset=utf8", "root", "");

$kadi = $_POST['kullanici_adi'];
$sifre = $_POST['sifre'];


if (!$kadi || !$sifre) {
    die("<center><font face='arial' color='white'> Boş Alan Bırakmayınız..! </font></center>");
}

$user = $db->query("SELECT * FROM kullanıcılar WHERE kullanici_adi = '$kadi' AND sifre = '$sifre'")->fetch();


if ($user) {
    $_SESSION['user'] = $user;
    header("Refresh: 3; url=anasayfa.php"); 
    echo "<center><font face='arial' color='white'>Giriş Başarılı <font color='black'> [$kadi] </font>   Anasayfaya Yönlendiriliyorsunuz.. </font></center>";
}else {
    echo "<center><font face='arial' color='white'> Bilgiler hatalı..! </font></center>";
}

?>

