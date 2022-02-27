$(document).ready(function() {
    $("#files").on("change", function(e) {
        var locale = document.getElementsByTagName("html")[0].getAttribute("lang");
        if(locale == 'ar'){
           var remove_message = 'حذف الصورة';
        }
        else{
           var remove_message = 'Remove image';
        }
        var files = e.target.files,
        filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\"> "+ remove_message +" </span>" +
                "</span>").insertAfter("#files");
                $(".remove").click(function(){
                $(this).parent(".pip").remove();
                });
             });
            fileReader.readAsDataURL(f);
        }
    });
  });