
function entering_article(element) {

    let prev = selected_article();
    if( prev && prev.id === element.id ) return;

    if (prev) leaving_article(prev);

    select_article(element);

    add_class(element, 'active-article');

    enable_add_tool(true);
    enable_article_tools(true);
    enable_move_tools(true);
    enable_delete_tool(true);
    enable_save_tool(true);
}

function leaving_article() {

    let article = selected_article();
    if (article) {
        remove_class(article, 'active-article');
    }


    enable_add_tool(false);
    enable_article_tools(false);
    enable_move_tools(false);
    enable_delete_tool(false);
    enable_save_tool(false);

    save_article();
    unselect_article();
}



function save_article() {

    let article = selected_article();
    if (article) {
        server('article/update', {
            id: article.id,
            pos: get_child_pos(article)
        });
        for( let i=0; i < article.childElementCount; i++) {
            let section = article.children[i];
            let func = 'update_' + section.getAttribute('type');
            window[func](section);
        }
    }


}
