<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Payment Confirmation</title>
</head>
<body>
    <p>{{$bookingMessage}}</p>
    <p>You can pay TIP to driver from below link</p>
    <a href="{{$paymentLink}}"></a>
    <p>Thank you,</p>
    <p>Sincerely</p>
    <p><b>JE Private Drivers</b></p>

    <div style="text-align:center; padding-top: 20px;">
        <span style="padding: 10px 30px; border-radius: 25px; background-color: rgb(82, 144, 226); font-weight: bold; width: 100%; cursor:pointer;"><a href="{{$paymentLink}}" style="color: white; text-decoration: none;">Add TIP</a></span>
    </div>
</body>
</html>
