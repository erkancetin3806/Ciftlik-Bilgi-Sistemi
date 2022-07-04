<?php
	require 'baglanti.php';

	$genel_toplam = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(urun_adi, '(',qty,')') AS ItemQty, Toplam_fiyat FROM sepet";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $genel_toplam += $row['Toplam_fiyat'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Siparişi Tamamla</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body class="bg-secondary">
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <a class="navbar-brand" href="satis_onay.php">&nbsp;&nbsp;BİZİM ÇİFTLİK - SİPARİŞİ TAMAMLA</a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
 
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item">
          <a class="nav-link" href="sepet.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div  class="container">
  <br><br><br><div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h1 class="text-center text-light p-2">Sipariş Bilgisi</h1>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Ürünler : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Kargo : </b>Ücretsiz</h6>
          <h5><b>Toplam Ödenecek Ücret : </b><?= number_format($genel_toplam) ?>₺</h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="genel_toplam" value="<?= $genel_toplam; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Ad Soyad" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="E-Mail Adresiniz" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Telefon Numaranız" required>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Teslimat Adresini Giriniz..."></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Siparişi Tamamla" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {


    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'kopru.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

   
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'kopru.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>