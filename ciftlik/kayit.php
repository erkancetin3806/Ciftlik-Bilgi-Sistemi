<!DOCTYPE html>

<html>

<head>
    <meta charset = 'utf-8' />
    <title>Kayıt Ol</title>
    <link href="css/nav.css" rel="stylesheet">
    <style type="text/css">
    body {margin:1; padding:0;}
        #kayit_formu {padding: 10px; width: 500px; margin: 50px auto; background: #ddd; border-radius: 5px;}
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
                <a href="giris.php">GİRİŞ YAP</a>
            </li>
        </ul>
    </nav>
   

  <br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="resim/kayit.png">
    
       
       
       <div id="kayit_formu">
    
    <form action="kayit.php" method="POST">
    
    <table>
        
        <tr>
        <td>Kullanıcı Adı :</td><td> <input type="text" name="kullanici_adi"> </td>
        </tr>
        
        <tr>
        <td>Şifre &emsp;&emsp;&emsp;:</td><td> <input type="password" name="sifre"> </td>
        </tr>
        
        <tr>
        <td>Mail Adresi &nbsp;:</td><td> <input type="text" name="mail"> </td>
        </tr>
		
		<tr>
        <td>Telefon &emsp;&emsp;:</td><td> <input type="number" name="telefon"> </td>
        </tr>
        
        <tr>
        <td></td><td> <input type="submit" id="button" value="Kayıt Ol"> </td>
        </tr>
    </table>
</form>
    
    </div>
    
</body>
</html>

<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=bizim_ciftlik;charset=utf8", "root", "");


$kullanici_adi = $_POST['kullanici_adi'];
$sifre = $_POST['sifre'];
$mail = $_POST['mail'];
$telefon = $_POST['telefon'];

if (!$kullanici_adi || !$sifre|| !$mail || !$telefon) {
    die("<center><font face='arial' color='white'> Lütfen Boş Alan Bırakmayınız. </center></font>");
}

$ekle = $db->prepare("INSERT INTO kullanıcılar SET kullanici_adi = ?, sifre = ?, mail = ?, telefon = ?");
$ekle->execute([$kullanici_adi, $sifre, $mail, $telefon]);

if ($ekle) {
    $_SESSION['ekle'] = $ekle;
    echo "<center><font face='arial' color='white'> Tebrikler Kayıt Oldunuz.Giriş Sayfasına Devam Etmek için Lütfen Tıklayınız</font></center>";
    echo ('<center><a href="giris.php">GİRİŞ YAP</a></center>');

}else {
    echo "Bir hata oluştu.";
}

