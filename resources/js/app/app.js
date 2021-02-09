function switchLang(no) {
  switch (no) {
    case 1:
      document.querySelector('html').dir="rtl";
      var head = document.getElementsByTagName("head")[0];
      var link = document.createElement("link");
      link.id = "lang";
      link.rel = "stylesheet";
      link.type = "text/css";
      link.href = "./assets/css/style-rtl.css";
      link.media = "all";
      head.appendChild(link);
      break;
    case 0:
      document.querySelector('html').dir="auto";
      if (document.getElementById("lang"))
        document.getElementById("lang").remove();
  }
}
var ul = document.querySelector(".dropdown-menu.dropdown-menu-right")
  .childNodes;
var a1 = ul[1].childNodes[1];
var a2 = ul[3].childNodes[1];

a1.addEventListener("click", function(){
  switchLang(0);
});

a2.addEventListener("click", function(){
  switchLang(1);
});

