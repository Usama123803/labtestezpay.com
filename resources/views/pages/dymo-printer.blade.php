<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>DYMO: QR-code</title>
    <!-- JQuery -->
    <script src = "http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript" charset="UTF-8"> </script>
    <!-- Dymo Script -->
    <script src="{{ asset('assets/js/DYMO.Label.Framework.2.0.2.js') }}"></script>
    <!-- QR Code -->
    <script src="{{ asset('assets/js/QRCode.js') }}"></script>
    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>

<div class="container">

    <div class="jumbotron">
        <h3>DYMO Label Framework JavaScript Library Samples: QR code</h3>
        <div class="header">
            <div id="sampleDesctiption">
                <span>
                    This sample shows different ways to print a label with a QR-code barcode.
                </span>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="printControls">

            <div class="row">
                <div class="col-md-6">
                    <div id="printersDiv">
                        <label for="printersSelect">Printer:</label><br/>
                        <select class="form-control" id="printersSelect"></select>
                    </div>
                </div>
            </div>

            <div id="printDiv" style="padding-top:20px">
                <button class="btn btn-primary btn-lg" id="printButton">Print QR Code</button>
            </div>

        </div>
    </div>

</div>



</body>

</html>
