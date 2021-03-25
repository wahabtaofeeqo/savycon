<!DOCTYPE html>
<html>
<head>
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

    	.invoice {
    		height: 100%;
    	}
    </style>
</head>
<body class="bg-white">

	<div id="app"></div>

    @yield('content')

    <script src="{{ asset('main/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('main/vendor/jspdf/dist/jspdf.umd.js') }}"></script>
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

    </script>
</body>
</html>