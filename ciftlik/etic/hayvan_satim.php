<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title> Satılık Hayvanlar </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="../css/nav.css" rel="stylesheet">
</head>

<body class="bg-secondary">
   <a href="../anasayfa.php"><img src="../resim/logo.png" align="left" width="195" height="105" alt="Web Sitesi Logosu" /></a>
<br>
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


    <!--Ürün Menü Bölümü-->

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="hayvan_satim.php">&nbsp;&nbsp;BİZİM ÇİFTLİK - SATILIK HAYVANLAR</a>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            
        </div>
    </nav>

    <div  class="#778899" class="container">
        <div id="message"></div>
        <div class="row mt-2 pb-3">
            <?php
  			include 'baglanti.php';
  			$stmt = $conn->prepare('SELECT * FROM hayvan_satim');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                <div class="card-deck">
                    <div class="card p-2 border-secondary mb-2">
                        <img src="<?= $row['satim_resim'] ?>" class="card-img-top" height="250">
                        <div class="card-body p-1">
                            <center>
                                <h4 class=""><?= $row['satim_ad'] ?></h4>
                            </center>
                            <h5 class="card-text text-center text-danger"><i class="currency fa fa-try"></i>&nbsp;&nbsp;<?= number_format($row['satim_fiyat']) ?></h5>

                        </div>
                        <div class="card-footer p-1">
                            <form action="" class="form-submit">
                                <div class="row p-2">
                                    <div class="col-md-6 py-1 pl-4">
                                        <b>Yaş: <font color="red"><?= $row['satim_yas'] ?></font> </b>
                                    </div>
                                    <div class="col-md-6 py-1 pl-4">
                                        <b>Cinsiyet:  <font color ="red"><?= $row['satim_cinsiyet'] ?></font></b>
                                    </div>
                                    <div class="col-md-12 ">
                                        <b>Kimlik No: <font color ="red"><?= $row['satim_kod'] ?></font></b>
                                    </div>
                                   
                                </div>
                                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                <input type="hidden" class="pname" value="<?= $row['satim_ad'] ?>">
                                <input type="hidden" class="pprice" value="<?= $row['satim_fiyat'] ?>">
                                <input type="hidden" class="pimage" value="<?= $row['satim_resim'] ?>">
                                <input type="hidden" class="pcode" value="<?= $row['satim_kod'] ?>">
                                <center><a href="hayvan_satim_form.php" class="btn btn-dark " role="button" aria-pressed="true">Satın Al</a>
 </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    
</body>

</html>
