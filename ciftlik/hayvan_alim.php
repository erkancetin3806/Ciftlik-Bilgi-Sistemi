<!DOCTYPE html>

<html>

<head>
    <meta charset = 'utf-8' />
    <title>Canlı Hayvan Alım</title>
    <link href="css/nav.css" rel="stylesheet">
    <style type="text/css">
    body {margin:1; padding:0;}
        #kayit_formu {padding: 10px; width: 500px; margin: 50px auto; background: #ddd; border-radius: 5px;}
        input {padding: 10px; border: 1px solid #ccc; border-radius: 3px;}
        #button {background-color: #fa3636; cursor: pointer; color: #fff; width: 185px;}     
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
  <br>
  <br>
 <center> <p> <font face="tahoma" size="6"> <b> CANLI HAYVAN ALIM </b> </font> </p>  </center> 
    
       
       
       <div id="kayit_formu">
    
    <form action="hayvan_alim.php" method="POST">
    
    <table>

        <tr>
         <center><p><b> Kendi bilgilerinizi ve çiftliğimize satmak istediğiniz canlı hayvanınızın bilgilerini girin. </b> </p></center>
        </tr
        <tr>
        <td>Adınız Soyadınız :</td><td> <input type="text" name="ad_soyad"> </td>
        </tr>
        
        <tr>
        <td>E-mail Adresiniz :</td><td> <input type="mail" name="mail"> </td>
        </tr>
    
        <tr>
        <td>Telefon Numaranız :</td><td> <input type="number" name="telefon"> </td>
        </tr>
        
        <tr>
        <td>Adresiniz :</td> <td> <textarea name="adres" id="" cols="22" rows="5"></textarea> <br> <br> </td> 
        </tr>

        <tr>
        <td>Hayvan bilgileri :</td> <td> <textarea name="hayvan" id="" cols="22" rows="5"></textarea> <br> <br> </td> 
        </tr>
        <tr>
            <td>Hayvan resmi :</td>
                <td><input type="file" name="resim" id="resim"></td>
        </tr>
        <tr>
        <td></td>  <td> <input type="submit" id="button" value="Gönder" > </td>
        </tr>
    </table>
</form>
    
    </div>
    
</body>
</html>

<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=bizim_ciftlik;charset=utf8", "root", "");


$alim_ad = $_POST['ad_soyad'];
$alim_email = $_POST['mail'];
$alim_telefon = $_POST['telefon'];
$alim_adres = $_POST['adres'];
$alim_bilgi = $_POST['hayvan'];
$alim_resim = $_POST['resim'];

if (!$alim_ad || !$alim_email || !$alim_telefon || !$alim_adres || !$alim_bilgi || !$alim_resim) {
    die("<center><font face='arial' color='white'> Lütfen Boş Alan Bırakmayınız. </center></font>");
}

$ekle = $db->prepare("INSERT INTO hayvan_alim SET alim_ad = ?, alim_email= ?, alim_telefon = ?, alim_adres = ?, alim_bilgi = ?, alim_resim = ?");
$ekle->execute([$alim_ad, $alim_email, $alim_telefon, $alim_adres, $alim_bilgi, $alim_resim]);

if ($ekle) {
    $_SESSION['ekle'] = $ekle;
    echo "<center><font face='arial' color='white'> Kayıt başarılı!! Değerlendirmemizin ardından size 2 gün içerisinde belirtmiş olduğunuz telefon ile irtibata geçilecektir.</font></center>";
    echo ('<center><a href="anasayfa.php">ANASAYFA</a></center>');

}else {
    echo "Bir hata oluştu.";
}

