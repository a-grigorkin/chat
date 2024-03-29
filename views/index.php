<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="css/style.css?3" rel="stylesheet">

    <title>Interactive chat</title>
</head>
<body>
<div class="container">
    <div class="row no-gutters">
        <div class="col-lg-6">
            <form id="form">
                <div class="row no-gutters mb-1">
                    <div class="col-lg-12">
                        <div id="chat" class="form-control"></div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-10">
                        <input type="text" id="inputMessage" class="form-control" placeholder="Type in your message here..." autofocus>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="buttonSend" class="btn btn-primary btn-block">
                            <i class="fa fa-paper-plane-o fa-lg"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-2 ml-lg-1">
            <div id="users" class="form-control">No user management implemented yet.</div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS --><!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
//-->
<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>