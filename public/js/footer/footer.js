
function get_footer() {

    server('footer/get', {}).then(
        (resolve) => {
            let nav = document.querySelector('footer');
            nav.innerHTML = resolve;
        }
    );
}

