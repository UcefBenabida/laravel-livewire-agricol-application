<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/../materialize/css/materialize.css">

    <title>Agricole Place</title>
    
    @livewireStyles()

    <style>
        button.mr-btn{
            margin-left: 34px;
            margin-right: 34px;
        }

        .row{
            margin: 5px;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="section"></div>

        <div class="container">

            

            @livewire('agriculteurs-list')

           

        </div>

        @livewireScripts()

</body>
</html>


