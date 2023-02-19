<!DOCTYPE html>
<html>
    <head>
        <title>Live</title>
        <link rel="stylesheet" href="bootstrap.css">
        <script src="bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="live-sale.css">
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
                        <a class="nav-link active" aria-current="page" href="farmer-interface.html" id="home">HOME</a>
                        </li>
                    </ul>
                </nav>
            <!--/div-->
        </div>
        <div class="row-fluid">
            <div class="col-8">
                <video autoplay controls poster="farm.gif" id="vid1">   
                </video>
                <span><video controls poster="" id="vid2">   
                </video></span>
                <div id="btns">
                    <button class="btn btn-danger" id="btn1">Start Live</button>
                    <span><button class="btn btn-secondary" id="btn2">Stop Live</button></span>
                </div>
            </div>
            <div class="col-3">
                <div class="card" id="card">
                    <img src="<?php echo $_COOKIE['img']; ?>"alt="">
                    <div class="card-body">
                        <h4 class="badge" id="name"><?php echo $_COOKIE['itemname']; ?></h4>
                    </div>
                </div>
                <div class="card" id="availability">
                    <h2>Status</h2>
                    <div class="card-body">
                        <label><input type="radio" name="availability" id="avail1"> Available</label>
                        <label><input type="radio" name="availability" id="avail2">Not Available</label>
                    </div>
                    <button id="submit" style="background-color:green; border:0px; width:150px; border-radius:10px;">UPDATE</button>
                </div>
            </div>
        </div>
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
