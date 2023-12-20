
function update_text(section) {

    server('update/section', {
        id: section.id,
        align: section.style.justifyContent,
        pos: get_child_pos(section),
        content: JSON.stringify( {
            text:  section.innerHTML
        })}
    );
}