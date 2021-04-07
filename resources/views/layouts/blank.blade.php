<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name') }}</title>

	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="{{ asset('js/app.js') }}"></script>

    <style type="text/css">
    	body, html {
    		height: 100%;
    	}

    	.wrapper {
    		height: 100%;
    	}
    </style>
</head>
<body>

	@yield('content')

    <script src="{{ asset('main/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('main/vendor/jspdf/dist/jspdf.umd.js') }}"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script type="text/javascript">

        $(".download").click(function(e) {
           
            var btn = $(this);
            btn.css('visibility', 'hidden');

            var doc = new jsPDF.jsPDF();

            var elementHTML = $('#invoice').html();
            html2canvas(document.body).then(function(canvas) {
                var captured = canvas.toDataURL('image/png');
                doc.addImage(captured, 'JPEG', 10, 10, 180, 180);
                doc.save('invoice.pdf');

                btn.css('visibility', 'visible');
            })
        })



        $("#btnContinueService").click(function(e) {

            const info = {
                amount: $(this).attr('data-price'),
                currency: $(this).attr('data-currency'),
                service: $(this).attr('data-service'),
                name: "<?php (request()->user()) ? request()->user()->name : 'Savycon' ?>",
                email: "<?php (request()->user()) ? request()->user()->email : 'user@savycon.com'; ?>",
                phone: "<?php (request()->user()) ? request()->user()->phone : '' ?>",
                description: $(this).attr('data-desc'),
            }

            makePayment(info);
        })

        function makePayment(info) {
                
            FlutterwaveCheckout({
                public_key: "FLWPUBK-3df0eb38dcdc8322952c52b996faa710-X", 
                tx_ref: "hooli-tx-1920bbtyt",
                amount: info.amount,
                currency: info.currency,
                country: (info.currency == "NGN") ? "NG" : "US",
                payment_options: "card, mobilemoneyghana, ussd",
                customer: {
                    email: info.email,
                    phone_number: info.phone,
                    name: info.name,
                },
                callback: (data) => {
                        
                    const post = {
                        transaction: data.transaction_id,
                        ref: data.flw_ref,
                        type: 'service',
                        service: info.service,
                        amount: info.amount,
                        description: info.description,
                    };

                    axios.post('/api/service-payment', post)
                    .then(response => {
                        location.href = '/donated';
                    })
                    .catch(err => {
                        console.log(err);
                    })
                },
                onclose: function() {
            
                },
                customizations: {
                    title: "Service Payment",
                    description: "Payment for Service on Savycon",
                },
            });
        }
    </script>
</body>
</html>