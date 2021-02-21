
$(function(){

    function ImagetoPrint(source) {
        return "<html><head><script>function step1(){\n" +
            "setTimeout('step2()', 10);}\n" +
            "function step2(){window.print();window.close()}\n" +
            "</scri" + "pt></head><body onload='step1()'>\n" +
            "<img src='" + source + "' /></body></html>";
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

});
