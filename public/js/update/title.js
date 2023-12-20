
function update_title(section) {

    let h1 = section.querySelector('h1');

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            title: h1.innerText
        })
    });
}

