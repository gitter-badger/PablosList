<!DOCTYPE html>
<html>
    <head>
        <title>Laravel5.dev</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- <link href="https://bootswatch.com/lumen/bootstrap.min.css" rel="stylesheet"> -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            #login-dp{
                min-width: 250px;
                padding: 14px 14px 0;
                overflow:hidden;
                background-color:rgba(255,255,255,.8);
            }
            #login-dp .help-block{
                font-size:12px
            }
            #login-dp .bottom{
                background-color:rgba(255,255,255,.8);
                border-top:1px solid #ddd;
                clear:both;
                padding:14px;
            }
            #login-dp .social-buttons{
                margin:12px 0
            }
            #login-dp .social-buttons a{
                width: 49%;
            }
            #login-dp .form-group {
                margin-bottom: 10px;
            }
            .btn-fb{
                color: #fff;
                background-color:#3b5998;
            }
            .btn-fb:hover{
                color: #fff;
                background-color:#496ebc
            }
            .btn-tw{
                color: #fff;
                background-color:#55acee;
            }
            .btn-tw:hover{
                color: #fff;
                background-color:#59b5fa;
            }
            @media(max-width:768px){
                #login-dp{
                    background-color: inherit;
                    color: #fff;
                }
                #login-dp .bottom{
                    background-color: inherit;
                    border-top:0 none;
                }
            }
            </style>
        @yield('style')
    </head>
