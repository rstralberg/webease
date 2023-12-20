
function get_title() {

    server('title/title', {
        pageid: pageid(),
        username: username()
    }).then(
        (resolve) => {
            let e = document.querySelector('header');
            e.innerHTML = resolve;
            e.style.display = show_title() || username() !== '' ? 'block' : 'none';
            if( e.style.display === 'block' &&
                username() === author) {
            }
        }
    );
}

