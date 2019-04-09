$(function() {
    $('[data-toggle="minimize"]').on('click',function(){
        $(this).closest('.card').toggleClass('minimize');
    });
});