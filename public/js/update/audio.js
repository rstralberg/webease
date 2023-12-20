
function update_audio(section) {

    server('update/section', {
        id: section.id,
        align: section.style.justifyContent,
        pos: get_child_pos(section),
        content: JSON.stringify( {
            src: filename_only(section.querySelector('audio').src),
            caption: section.querySelector('figcaption').innerText
        })
    });
}
