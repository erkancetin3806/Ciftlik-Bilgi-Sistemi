<?php
	session_start();
	require 'baglanti.php';

	// Sepet tablosuna ürün ekleyin
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $Toplam_fiyat = $pprice * $pqty;

	  $stmt = $conn->prepare('SELECT urun_kodu FROM sepet WHERE urun_kodu=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['urun_kodu'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO sepet (urun_adi,urun_fiyat,urun_resim,qty,Toplam_fiyat,urun_kodu) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$Toplam_fiyat,$pcode);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Ürün Sepete Eklendi..</strong>
						</div>';
	  } 
	}

	// Sepet tablosuna ekleyin
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM sepet');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Tekil ürünleri alışveriş sepetinden kaldır
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM sepet WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Ürünü Kaldırdınız..!';
	  header('location:sepet.php');
	}

	// Tüm ürünleri bir defada sepetten çıkarın
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM sepet');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Sepetteki Tüm Ürünler Kaldırıldı..!';
	  header('location:sepet.php');
	}

	// Sepet tablosunda ürünün toplam fiyatını belirleyin
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE sepet SET qty=?, Toplam_fiyat=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Ödeme yapın ve müşteri bilgilerini siparişler tablosuna kaydedin
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $genel_toplam = $_POST['genel_toplam'];
	  $address = $_POST['address'];

	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO siparisler (isim,email,telefon,address,urun,odenen_miktar)VALUES(?,?,?,?,?,?)');
	  $stmt->bind_param('ssssss',$name,$email,$phone,$address,$products,$genel_toplam);
	  $stmt->execute();
	  $stmt2 = $conn->prepare('DELETE FROM sepet');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-light">Teşekkürler!</h1><br>
								<h2 class="text-warning">Siparişiniz Tamamlandı! Siparişinizin Kapıda Ödeneceğini Unutmayınız..</h2><br>
								<h4 class="bg-danger text-light rounded p-2">Satın Alınan Ürünler : ' . $products . '</h4><br>
								<h4>Ad Soyad : ' . $name . '</h4>
								<h4>E-mail : ' . $email . '</h4>
								<h4>Telefon : ' . $phone . '</h4>
								<h4>Toplam Tutar: ' . number_format($genel_toplam) . ' ₺</h4>
                                <a href=urunler.php><font color="white" size="5">ANASAYFA</font></>
						  </div>';
	  echo $data;
	} 
  
?>