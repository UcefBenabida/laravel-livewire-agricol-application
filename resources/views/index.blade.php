<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agricol Place</title>
    <link type="text/css" rel="stylesheet" href="/../materialize/css/materialize.css"  media="screen,projection"/>

    <style>
       #container{
           position: absolute;
           top: 200px;
           left: 30%;
           width: 40%;
           background-color: rgb(163 230 53);
           height: 400px;
           border-radius: 15px 15px 15px 15px;

           
       }

       .link-login{
           margin-top: -100px;
           margin-left:140px;
           font-size: 24px;
           color: white;
       }
      
       #title{
            color: rgb(212, 95, 17);
            margin-top: 80px; 
            margin-left: 350px;
            font-weight: 1500; 
            font-size:34px;
            font-weight: 900;
       }
       #logo{
           margin-top: -60px;
       }
    </style>
    @livewireStyles()
   
</head>
<body>

    <div class="section"></div>
    
    <div id="container" class="z-depth-1">

        <div id="title">
            Agricol Place
        </div>

        <img id="logo" src="/../images/logo.png" height="300px" width="300px"  />

        <div class="link-login center-align">
            <a href="{{ route('login') }}"><b>login to explore ▶</b></a>
        </div>

    </div>

    
   


    @livewireScripts()
</body>
</html>