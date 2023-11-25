<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Password</title>
</head>
<body>
    <p>Dear, {{$mailData['name']}}</p>
    <p>Please set your password and login by clicking on below link</p>
    <p>Thank you,</p>
    <p>Sincerely</p>
    <p>JE Private Drivers</p>
    <div style="text-align:center; padding-top: 20px;">
                    <span style="padding: 10px 30px; border-radius: 25px; background-color: rgb(82, 144, 226); font-weight: bold; width: 100%; cursor:pointer;"><a href="{{$mailData['url']}}" style="color: white; text-decoration: none;">Set Password</a></span>
    </div>
</body>
</html>
