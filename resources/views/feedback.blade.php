<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feeback</title>

    <!-- Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- CSS -->
    <style>
        .page{
            display : inline-flex;
            justify-content : center;
        }
        form{
            width : 500px;
            margin : 2rem 0;
            display : flex;
            flex-direction : column;
            align-items : center;
        }
        input,textarea{
            margin : 1rem 0;
        }
        .title{
            color : gray;
            font-size : 24px;
            font-weight : bold;
        }
        .success{
            width : 500px;
            margin : 5rem 0;
            text-align : center;
        }
    </style>
</head>
<body>
    <div class = "container-fluid page">
        <form class="form-group" id = "feedback">
            <div class = "title">Feedback</div>
            <input class = "form-control" type = "text" name = "name" placeholder = "Name"/>
            <input class = "form-control" type = "text" name = "email" placeholder = "Email"/>
            <textarea class = "form-control" name="content" cols="50" rows="10" placeholder = "Feeback"></textarea>
            <button class="btn btn-primary">
                Send
                <i class="fa fa-spinner fa-spin"></i>
            </button>
        </form>

        <div class = "success">Thank you for your feedback!</div>
    </div>
</body>

<script>
    $('.success').hide();
    $('.fa-spin').hide();
    $('#feedback').submit(function(event){
        event.preventDefault();
        $('.fa-spin').show();
        $.post('{{ url("/api/sendmail") }}',$("#feedback").serialize(),function(data){
            $('#feedback').hide();
            $('.success').show();
        })
    })
</script>
</html>