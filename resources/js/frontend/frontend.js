var sidebarLinkToggle = function (e) {
    e.nextElementSibling.classList.toggle("d-block");
    console.log(e.childNodes[5].classList.toggle("icon-down"));
};
