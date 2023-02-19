<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Home')?>

<link href="style.css" rel="stylesheet" type="text/css">
<section class="home" id="home" >
	
    <div class="content"><br><br><br>
        <p align="center"><b>GET YOUR FRUITS AND VEGETABLES DIRECTLY FROM FARMERS</b></p>
        <a href="#" class="btn1"><b></b></a>
    </div>
    <div class="container mt-3" id="carousel">
        <div id="myCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
            
            <ol class="carousel-indicators">
                <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="3"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="4"></li>
            </ol>

            <div class="carousel-inner" id="c-inner">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img id="c-img" style="height:450px; width:1900px;" src="fresh.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption">
                        <h3>AGRI WAVE</h3>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="6000">
                    <img id="c-img"  style="height:450px; width:1900px;" src="banner1.jpg" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item" data-bs-interval=" 6000 ">
                    <img id="c-img" style="height:450px; width:1900px;" src="4.jpeg" class="d-block w-100" alt="Slide 3">
                </div>
                <div class="carousel-item" data-bs-interval=" 6000 ">
                    <img id="c-img"  style="height:450px; width:1900px;" src="5.jpg" class="d-block w-100" alt="Slide 4">
                </div>
                <div class="carousel-item" data-bs-interval=" 6000 ">
                    <img  id="c-img" style="height:450px; width:1900px;" src="cu.jpg" class="d-block w-100" alt="Slide 5">
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</section><br><br>	
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=2<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="300" height="250" alt="<?=$product['name']?>">
            <span class="name"><b><?=$product['name']?></b></span>
            <span class="price">
                &#8377;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&#8377;<?=$product['rrp']?></span>
                <?php endif; ?>	
         </span>
        </a>
	<a href="index.php?page=result&id=<?=$product['id']?>" class="btn">GO TO LIVE</a>	
        <?php endforeach; ?>
	
    </div>
</div>

<?=template_footer()?>
