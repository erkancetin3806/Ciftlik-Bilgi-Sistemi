<!DOCTYPE html>

<html>

<head>
    <meta charset = 'utf-8' />
    <title>Canlı Hayvan Satım</title>
    <link href="../css/nav.css" rel="stylesheet">
    <style type="text/css">
    body {margin:1; padding:0;}
        #kayit_formu {padding: 10px; width: 500px; margin: 50px auto; background: #ddd; border-radius: 5px;}
        input {padding: 10px; border: 1px solid #ccc; border-radius: 3px;}
        #button {background-color: #fa3636; cursor: pointer; color: #fff; width: 185px;}     
    </style>
    
</head>

<body bgcolor="lightslategray">
    <a href="../anasayfa.php"><img src="../resim/logo.png" align="left" width="195" height="105" alt="Web Sitesi Logosu" /></a>

    <nav>
        <ul class="navigasyon">
            <li>
                <a href="../anasayfa.php">ANASAYFA</a>
            </li>
            <li><a href="urunler.php">ÜRÜNLER</a>
            </li>
            <li>
                <a href="../hayvan_bilgi.php">HAYVAN BİLGİ</a>
            </li>
            <li>
                <a href="../hayvan_alim.php">CANLI HAYVAN ALIM</a>
            </li>
            <li>
                <a href="hayvan_satim.php">CANLI HAYVAN SATIM</a>
            </li>
            <li>
                <a href="../hakkimizda.php">HAKKIMIZDA</a>
            </li>
            <li>
                <a href="../iletisim.php">İLETİŞİM</a>
            </li>
            <li>
                <a href="../kayit.php">KAYIT OL</a>
            </li>
            <li>
                <a href="../giris.php">GİRİŞ YAP</a>
            </li>
        </ul>
    </nav>
  <br>
  <br>
 <center> <p> <font face="tahoma" size="6"> <b> CANLI HAYVAN SATIM </b> </font> </p>  </center> 
    
       
       
       <div id="kayit_formu">
    
    <form action="#" method="POST">
    
    <table>

        <tr>
         <center><p><b> Kendi bilgilerinizi ve almak istediğiniz hayvanın kimlik numarısını giriniz. </b> </p></center>
        </tr

        <tr>
        <td>Adınız Soyadınız :</td><td> <input type="text" name="satilan_ad"> </td>
        </tr>
        
        <tr>
        <td>E-mail Adresiniz :</td><td> <input type="mail" name="satilan_mail"> </td>
        </tr>
    
        <tr>
        <td>Telefon Numaranız :</td><td> <input type="number" name="satilan_telefon"> </td>
        </tr>

        <tr>
        <td>Hayvan Kimlik No :</td><td> <input type="text" name="satilan_hayvan_kimlik_no"> </td>
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


$satilan_ad = $_POST['satilan_ad'];
$satilan_mail = $_POST['satilan_mail'];
$satilan_telefon = $_POST['satilan_telefon'];
$satilan_hayvan_kimlik_no = $_POST['satilan_hayvan_kimlik_no'];


if (!$satilan_ad || !$satilan_mail || !$satilan_telefon || !$satilan_hayvan_kimlik_no) {
    die("<center><font face='arial' color='white'> Lütfen Boş Alan Bırakmayınız. </center></font>");
}

$ekle = $db->prepare("INSERT INTO hayvan_satilan SET satilan_ad = ?, satilan_mail= ?, satilan_telefon = ?, satilan_hayvan_kimlik_no = ?");
$ekle->execute([$satilan_ad, $satilan_mail, $satilan_telefon, $satilan_hayvan_kimlik_no]);

if ($ekle) {
    $_SESSION['ekle'] = $ekle;
    echo "<center><font face='arial' color='white'> Kayıt başarılı!! Değerlendirmemizin ardından size 2 gün içerisinde belirtmiş olduğunuz telefon ile irtibata geçilecektir.</font></center>";
    echo ('<center><a href="../anasayfa.php">ANASAYFA</a></center>');

}else {
    echo "Bir hata oluştu.";
}

