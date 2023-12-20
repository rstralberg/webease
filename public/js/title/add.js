function add_title() {
    simple('s-title', 'Titel', 'Ange titeln', '', 'on_title_name') ;
}


function on_title_name(element) {
    
    let article = selected_article();
    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'title',
        align: 'center',
        content: JSON.stringify( {
            title: element.value
        })
    }).then( 
        () => {
            get_content();
        }
        );
    remove_form('s-title');
}
