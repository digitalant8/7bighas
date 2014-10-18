$(document).ready(function(){
    var fileurl = $(location).attr('pathname');
    var filename = fileurl.substring((fileurl.lastIndexOf("/") + 1), (fileurl.length));
    $('ul.nav > li > a[href="'+filename+'"]').parent().addClass('active');
});