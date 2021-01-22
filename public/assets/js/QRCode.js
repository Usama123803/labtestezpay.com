// stores loaded label info
var barcodeLabel;

// called when the document loaded
function onload() {
    var printersSelect = document.getElementById('printersSelect');
    var printButton = document.getElementById('printButton');

    // loads all supported printers into a combo box 
    function loadPrinters() {
        var printers = dymo.label.framework.getLabelWriterPrinters();
        if (printers.length == 0) {
            alert("No DYMO printers are installed. Install DYMO printers.");
            return;
        }
        console.log("got here: ", printers );

        for (var i = 0; i < printers.length; i++) {
            var printer = printers[i];

            var printerName = printer.name;

            var option = document.createElement('option');
            option.value = printerName;
            option.appendChild(document.createTextNode(printerName));
            printersSelect.appendChild(option);
        }
    }

    printButton.onclick = function () {
            var label_text = 'QRCode Text Here..';

            barcodeLabel.setObjectText('Barcode', label_text);

            // Should Be Printer Name, Dymo 450 Turbo..
            console.log("print: ", printersSelect.value );

            barcodeLabel.print( printersSelect.value );

    }

    function getBarcodeLabelXml() {

        var labelXml = '<?xml version="1.0" encoding="utf-8"?>\
                            <DieCutLabel Version="8.0" Units="twips">\
                                <PaperOrientation>Landscape</PaperOrientation>\
                                <Id>Address</Id>\
                                <PaperName>30252 Address</PaperName>\
                                <DrawCommands>\
                                    <RoundRectangle X="0" Y="0" Width="1581" Height="5040" Rx="270" Ry="270" />\
                                </DrawCommands>\
                                <ObjectInfo>\
                                    <BarcodeObject>\
                                        <Name>Barcode</Name>\
                                        <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />\
                                        <BackColor Alpha="0" Red="255" Green="255" Blue="255" />\
                                        <LinkedObjectName></LinkedObjectName>\
                                        <Rotation>Rotation0</Rotation>\
                                        <IsMirrored>False</IsMirrored>\
                                        <IsVariable>False</IsVariable>\
                                        <Text></Text>\
                                        <Type>QRCode</Type>\
                                        <Size>Small</Size>\
                                        <TextPosition>None</TextPosition>\
                                        <TextFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />\
                                        <CheckSumFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />\
                                        <TextEmbedding>None</TextEmbedding>\
                                        <ECLevel>0</ECLevel>\
                                        <HorizontalAlignment>Center</HorizontalAlignment>\
                                        <QuietZonesPadding Left="0" Top="300" Right="600" Bottom="0" />\
                                    </BarcodeObject>\
                                    <Bounds X="331" Y="57.9999999999999" Width="2880" Height="1435" />\
                                </ObjectInfo>\
                            </DieCutLabel>';
        return labelXml;
    }

    function loadLabelFromWeb() {
        barcodeLabel = dymo.label.framework.openLabelXml( getBarcodeLabelXml() );
    }

    // Load Labels 
    loadLabelFromWeb();

    // load printers list on startup
    loadPrinters();
};

// Run's Dymo Javascript.. 
dymo.label.framework.init(onload);