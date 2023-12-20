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
