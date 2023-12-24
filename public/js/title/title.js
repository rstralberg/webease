
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

function update_title(section) {

    let h1 = section.querySelector('h1');

    server('update/section', {
        id: section.id,
        align: section.style.justifyContent,
        pos: get_child_pos(section),
        content: JSON.stringify( {
            title: h1.innerText
        })
    });
}