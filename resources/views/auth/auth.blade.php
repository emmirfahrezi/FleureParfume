<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleure Parfume - Auth</title>

    <style>
        body {
            margin: 0;
            padding: 0;

            /* Background dari foto lo */
            background: url('/images/bg-auth.jpg') no-repeat center center fixed;
            background-size: cover;

            font-family: 'Poppins', sans-serif;
        }

        /* Layer gelap biar form keliatan */
        .overlay {
            background: rgba(0, 0, 0, 0.45);
            width: 100%;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-box {
            background: white;
            padding: 35px;
            width: 380px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        .auth-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #6d4caf; /* Warna ungu parfum */
        }

        .input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 15px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #6d4caf;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #5c3fb0;
        }

        .link {
            text-align: center;
            display: block;
            margin-top: 12px;
            font-size: 14px;
            color: #6d4caf;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

    <div class="overlay">
        @yield('content')
    </div>

</body>
</html>
