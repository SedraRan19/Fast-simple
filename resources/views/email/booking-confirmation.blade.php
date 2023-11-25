<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Confirmation</title>
</head>
<body>
    <p>{{$bookingMessage}}</p>
    <p><b>Client name:</b> {{$data['customer']}}</p>
    <p><b>Date and time:</b> {{$data['date']}}</p>
    <p><b>Pickup address:</b> {{$data['src-address']}}</p>
    <p><b>Destination:</b> {{$data['dst-address']}}</p>
    <p><b>Passengers:</b> {{$data['passenger_count']}}</p>
    <p><b>Passenger name:</b> {{$data['passenger_name']}}</p>
    <p><b>Passenger phone#:</b> {{$data['passenger_number']}}</p>
    <p>Thank you,</p>
    <p>Sincerely</p>
    <p><b>JE Private Drivers</b></p>
    <div style="text-align:center; padding-top: 20px;">
                    <span style="padding: 10px 30px; border-radius: 25px; background-color: rgb(82, 144, 226); font-weight: bold; width: 100%; cursor:pointer;"><a href="{{url('/')}}" style="color: white; text-decoration: none;">Go To Dashboard</a></span>
    </div>
</body>
</html>
