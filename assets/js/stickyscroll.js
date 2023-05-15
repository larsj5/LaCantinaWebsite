window.onscroll = function() { sticky() }; 

let header = document.getElementById('sticky-header');
let stickycomponent = header.offsetTop; 

function sticky() {
    if (window.pageYOffset > stickycomponent+650) {
        header.classList.add("sticky");
    }
    else {
        header.classList.remove("sticky");
    }
}