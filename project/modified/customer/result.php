<!DOCTYPE html>
<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<html>
    <head>
        <title>Live</title>
        <link rel="stylesheet" href="bootstrap.css">
        <script src="bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="result.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="c">
            <!--div class="row" id="navigation"-->
                <nav class="navbar fixed-top navbar-expand-lg" id="navigation">
                    <!--div class="container-fluid"-->
                      <a class="navbar-brand" href="#" id="brand">
                        <img src="logo.png" alt="logo" width="80px" height="60px" id="logo">
                        <span id="title">Agri Wave</span>
                      </a>
                    <ul class="navbar-nav" id="nav-items">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php" id="home">HOME</a>
                        </li>
                    </ul>
                </nav>
            <!--/div-->
        </div>
        <div class="row-fluid">
            <div class="col-2">
                <video autoplay controls poster="farm.gif" id="vid1">   
                </video>
                <span><video controls poster="" id="vid2">   
                </video></span>
		<div class="card" id="availability">
                    <h2>Status</h2>
   
                        <label><input type="radio" name="availability" id="avail1"> Available</label>
                        <label><input type="radio" name="availability" id="avail2">Not Available</label>
                  
                 
                </div>
                <div id="btns">
                    <span><button class="btn btn-danger" id="btn1">LIVE STREAMING<br></button>
                </div>
		<h5 id="end">End within 10mins</h5>
            </div>
	   <div class="col-2	" id="add" >
           <?=template_header('Product')?>
	     <div class="product content-wrapper" id="">
    		<img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
    		   <div>
       			<h1 class="name"><?=$product['name']?></h1>
        		<span class="price">
            		&#8377;<?=$product['price']?>
            		<?php if ($product['rrp'] > 0): ?>
            		<span class="rrp">&#8377;<?=$product['rrp']?></span>
            		<?php endif; ?>
        		</span>
        	<form action="index.php?page=cart" method="post" >
            		<input type="number" id="add1" name="quantity" value="1" min="1" id="addl" max="<?=$product['quantity']?>" placeholder="Quantity" required>
           		 <input type="hidden" name="product_id" value="<?=$product['id']?>">
            		<input type="submit" id="add2" value="BUY NOW">
       		 </form>
        		<div class="description">
            		<?=$product['desc']?>
       		 	</div>
    		</div>
	     </div>

	<?=template_footer()?>
            </div>
       </div>
<section>

</section>
       <script>
            $('#vid2').hide('fast');
            let video = document.querySelector("#vid1");
            let start_button = document.querySelector("#btn1");
            let stop_button = document.querySelector("#btn2");
            let saved=document.querySelector('#vid2');

            let camera_stream = null;
            let media_recorder = null;
            let blobs_recorded = [];
            start_button.addEventListener('click', async function() {
                // set MIME type of recording as video/webm
                $('#vid2').hide('fast');
                $('#vid1').show('fast');
                blobs_recorded=[];
                camera_stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                video.srcObject = camera_stream;
                media_recorder = new MediaRecorder(camera_stream, { mimeType: 'video/webm' });

                // event : new recorded video blob available 
                media_recorder.addEventListener('dataavailable', function(e) {
                    blobs_recorded.push(e.data);
                });

                // event : recording stopped & all blobs sent

                // start recording with each recorded blob having 1 second video
                media_recorder.start(1000);
            });

            stop_button.addEventListener('click', function() {
                //media_recorder.stop(); 
                //location.href='view.php';
                camera_stream.getTracks().forEach(function(track) {
                    track.stop();
                    });
                let video_local = URL.createObjectURL(new Blob(blobs_recorded, { type: 'video/webm' }));
                    $('#vid1').hide('fast');
                    $('#vid2').show('fast');
                    saved.src=video_local;      
            });
            /*document.getElementById('submit').addEventListener('click',function(){
                document.getElementById('submit').innerHTML='updated';
                if(document.getElementById('avail1').checked == true) {
                        document.cookie='availability=Avaialable';  
                    } 
                if (document.getElementById('avail2').checked == true){  
                        var a='Not avaolable'
                        document.cookie='availability=Not Available'+a;
                }  
                      
            });*/
       </script>
    </body>
</html>
