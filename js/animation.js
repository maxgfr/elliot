var sideBarIsOpen = 0;

function setSideBarStatus(){
  if(sideBarIsOpen==0){
    openSideBar();
  }
  else{
    closeSideBar();
  }
}

function openSideBar() {
  document.getElementById("mainHeader").style.marginLeft = "190px";

  document.getElementById("main").style.transform = "scale(0.9,1)";

  document.getElementById("mySideBar").style.width = "260px";
  document.getElementById("mySideBar").style.display = "block";
  document.getElementById("bigIcon").style.display = "block";

  document.getElementById("iconBar").style.width = "0px";
  sideBarIsOpen = 1;
}
function closeSideBar() {
  document.getElementById("mainHeader").style.marginLeft = "0%";

  document.getElementById("main").style.transform = "scale(1,1)";

  document.getElementById("mySideBar").style.width = "0px";
  document.getElementById("mySideBar").style.display = "none";
  document.getElementById("bigIcon").style.display = "none";

  document.getElementById("iconBar").style.width = "70px";
  sideBarIsOpen = 0;
}
