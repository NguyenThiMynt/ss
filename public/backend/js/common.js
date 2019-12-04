$(document).ready(function () {
   var width = $(window).width();
   console.log(width);
   if(width < 992){
       $('body.skin-blue').addClass('sidebar-collapse');
   }else{
       $('body.skin-blue').removeClass('sidebar-collapse');
   }
});