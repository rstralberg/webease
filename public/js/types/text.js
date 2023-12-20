function add_text() {

    let article = selected_article();

    server('add/section', {
        articleId: article.id,
        align: 'left',
        type: 'text',
        pos: article.childElementCount,
        content: JSON.stringify( {
            text: '...'
        })
    }).then(
        () => {
            get_content();
        }
    );
}

function update_text(section) {


    server('update/section', {
        id: section.id,
        align: section.style.justifyContent,
        pos: get_child_pos(section),
        content: JSON.stringify( {
            text:  section.innerHTML
        })}
    ).then(
        () => {
            get_content();
        }
    );
}