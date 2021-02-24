
$(function(){

    function ImagetoPrint(source) {
        return "<html><head><script>function step1(){\n" +
            "setTimeout('step2()', 10);}\n" +
            "function step2(){window.print();window.close()}\n" +
            "</scri" + "pt></head><body onload='step1()'>\n" +
            "<img src='" + source + "' height='100%' /></body></html>";
    }

    function PrintImage(source)
    {
        var Pagelink = "about:blank";
        var pwa = window.open(Pagelink, "_new");
        pwa.document.open();
        pwa.document.write(ImagetoPrint(source));
        pwa.document.close();
    }

    $(document).on("click",".print-image",function(){
        const path = $(this).data("path");
        PrintImage(path);
    });

    // $('.fancybox').fancybox();

    $(document).on('click','.fancybox-manual-a',function() {
        const url = $(this).data('url');
        $.fancybox.open(url);
    });

    // $("#reportUploadBtn").click(function(){
    //     var $fileUpload = $("input[type='file']");
    //     if (parseInt($fileUpload.get(0).files.length) > 1){
    //         alert("You are only allowed to upload a maximum of 1 files");
    //         return;
    //     }
    // });

    $("#pdfFile").on("change", function() {
        if ($("#pdfFile")[0].files.length > 20) {
            $('#reportUploadBtn').attr('disabled',true);
            alert("You can select only 20 pdf");
        } else {
            $('#reportUploadBtn').attr('disabled',false);
        }
    });

});
