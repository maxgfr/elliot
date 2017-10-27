function openSideBar() {
	document.getElementById("sidebar").style.width = "300px";
}
  
function closeSideBar() {
	document.getElementById("sidebar").style.width = "0";
}

$(window).scroll(function(){
    if ($(window).scrollTop() >= 300) {
       $('nav').addClass('fixed-header');
    }
    else {
       $('nav').removeClass('fixed-header');
    }
});