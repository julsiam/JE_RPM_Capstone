<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            width: 75px;
        }

        .payment-details span {
            color: #A9B0BB;
            /* display: block; */
        }

        .payment-info span {
            color: #A9B0BB;
            /* display: block; */
        }

        .payment-details a {
            /* display: inline-block; */
            margin-top: 5px;
        }

        .receipt-content .invoice-wrapper .line-items {
            color: #A9B0BB;
        }

        .line-items .print a {
            /* display: inline-block; */
            border: 1px solid #9CB5D6;
            padding: 13px 13px;
            border-radius: 5px;
            color: #708DC0;
            font-size: 13px;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            -ms-transition: all 0.2s linear;
            -o-transition: all 0.2s linear;
            transition: all 0.2s linear;
        }

        .receipt-content .invoice-wrapper .line-items .print a:hover {
            text-decoration: none;
            border-color: #333;
            color: #333;
        }

        .receipt-content .invoice-wrapper .line-items .total {
            margin-top: 30px;
        }

        .receipt-content .invoice-wrapper .line-items .total .extra-notes {
            float: left;
            width: 40%;
            font-size: 13px;
            color: #7A7A7A;
            line-height: 20px;
        }

        .receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
            display: block;
            margin-bottom: 5px;
            color: #454545;
        }

        .receipt-content .invoice-wrapper .line-items .total .field {
            margin-bottom: 7px;
            font-size: 14px;
            color: #555;
        }

        .receipt-content .invoice-wrapper .line-items .total .field.grand-total {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        .receipt-content .invoice-wrapper .line-items .print {
            margin-top: 50px;
            text-align: center;
        }

        .receipt-content{
            width: 65%;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 30px;
            background-color: #EFEFEF;
            

        }

    </style>
</head>

<body>
    <div class="receipt-content">
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-wrapper mb-4">
                        <div class="intro">
                            <p>Hello, <strong>{{ $mailData['first_name'] }} </strong> ,</p>
                            <br>
                            This email serves as proof or receipt for your rental payment of ₱
                            <strong>{{ $mailData['amount_paid'] }}</strong> on the rent from
                            <strong>{{ $mailData['rent_from'] }} </strong>to
                            <strong>{{ $mailData['due_date'] }}</strong> <br><i>See details below....</i>
                        </div>
                        <hr>

                        <div class="payment-info">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Payment Date</span>
                                    <strong>{{ $mailData['date_paid'] }}</strong>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Address</span>
                                    <strong>{{ $mailData['location'] }}</strong>
                                </div>
                            </div>
                        </div> 

                        <div class="payment-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Tenant</span>
                                    <strong>
                                        {{ $mailData['first_name'] }} {{ $mailData['last_name'] }}
                                    </strong>
                                    <p>
                                        {{ $mailData['location'] }} <br>
                                        {{ $mailData['room_unit'] }} <br>
                                    </p>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Payment To</span>
                                    <strong>
                                        Christine Toledo
                                    </strong>
                                    <p>
                                        Danao City<br>
                                        Cebu, Phippines <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="payment-info"> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Rental Breakdown</span>
                                    <div class="headers clearfix">
                                        <div class="row">
                                            <p>
                                                Room Rent: <strong> ₱ {{ $mailData['room_rent'] }}</strong><br>
                                                Electric Bill: <strong> ₱ {{ $mailData['electric_bill'] }}</strong> <br>
                                                Water Bill: <strong> ₱ {{ $mailData['water_bill'] }}</strong> <br>
                                            </p>

                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <span>Total Bill</span>
                                            <strong>₱ {{ $mailData['total_bill'] }}</strong>
                                        </div>
                                    </div>
                                </div> 
                                <hr>



                                <div class="line-items">
                                    <div class="headers clearfix">
                                        <div class="row">
                                            <div class="col-xs-4"><strong>Notes: </strong> <br>
                                                This payment is from <strong>{{ $mailData['rent_from'] }} </strong> to {{ $mailData['due_date'] }}</div>
                                        </div>
                                    </div>

                                    <div class="headers clearfix">
                                        <div class="row">
                                            <div class="col-xs-4"> <strong>Pahimangno: </strong> <br>
                                                Bayad lang ta sa atung due date ha para mas masaya, just don't forget
                                                po!
                                                Thanks a lot.</div>
                                        </div>
                                    </div>

                                    <div class="total">
                                        <p class="extra-notes">
                                            <strong> Cheers, </strong>
                                            <strong> J and E Rentals and Property</strong>
                                            Danao City, Cebu Philippines <br>
                                            JE_RPM 2023
                                        </p> <br><br><br>
                                    </div>


                                    <div class="print text-center">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
