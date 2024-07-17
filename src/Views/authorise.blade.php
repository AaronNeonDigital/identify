<!DOCTYPE html>
<html lang="en">

<head>
    <title>Authorise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f5f5f5;
            font-size: 12px;
            font-family: sans-serif;
        }

        h2 {
            display: block;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 30px;
            text-align: center;
            color: #dc261c;
            text-transform: uppercase;
        }

        .logo {
            padding: 60px;
            margin: auto auto;
            display: block;
        }

        .align-center {
            text-align: center;
        }

        .message {
            font-size:14px;
            text-align: center;
            color: #7777772;
            margin-bottom: 0;
            margin-top: 25px;
        }

        .container {
            width:100%;
        }

        .panel {
            width: 100%;
            max-width: 500px;
            margin: auto auto;
            background: #fff;
            padding: 30px;
            line-height: 20px;
            text-align: left;
            border-top: 3px solid #dc261c;
            border-bottom: 3px solid #dc261c;
            box-shadow: 0 0 10px 0 #d6d6d6;
        }

        .panel:hover {
            box-shadow: 0 0 20px 0 #888;
            transition: box-shadow .6s ease 0s;
        }

        .font-style {
            font-size: 14px;
            line-height: 22px;
            color: #5a5a5a;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            padding: 15px 25px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-resend {
            background-color: #fff;
            color: #000;
        }

        .btn-resend:hover {
            background-color: #f5f5f5;
        }

        .btn-cancel {
            background-color: #fff;
            color: #8a8a8a;
            font-size: 14px;
            padding: 5px 15px;
            border: none;
        }

        .btn-cancel:hover {
            color: #000;
        }
    </style>
</head>

<body>

    <div class="container">

        <img src="/img/logo.png" class="logo" alt="Isuzu Truck">

        <div class="panel">
            <h2>Authorise New Device</h2>
            <div class="text-center">
                <div class="font-style">
                    <p>
                        A message with a confirmation link has been sent to your email address.
                    </p>
                    <p>
                        <strong>Please click the confirmation link to continue</strong>
                    </p>
                </div>

                <form action="{{ route('identify.authorise.resend') }}" method="POST">
                    {{ csrf_field() }}

                    <button class="btn btn-resend" type="submit">
                        Resend Confirmation Email
                    </button>
                </form>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-cancel">
                        Cancel
                    </button>
                </form>

                @if(Session::has('msg'))
                    <p class="message">
                        <strong>{!!Session::get('msg')!!}</strong>
                    </p>
                @endif

            </div>
        </div>

    </div>
</body>

</html>
