
function get_navbar() {

    server('navbar/navbar', {
        username: username(),
        pageid: pageid()
    }).then(
        (resolve) => {
            let nav = document.querySelector('nav');
            nav.innerHTML = resolve;
        }
    );
}


function on_toggle_navbar() {
    let nav = document.querySelector('nav');
    if (nav.classList.contains('responsive')) {
        nav.classList.remove('responsive');
    }
    else {
        nav.classList.add('responsive');
    }
}