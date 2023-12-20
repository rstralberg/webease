
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
}

function leaving_article() {

    let element = selected_article();
    if (element) {
        remove_class(element, 'active-article');
    }


    enable_add_tool(false);
    enable_article_tools(false);
    enable_move_tools(false);
    enable_delete_tool(false);

    if (element) {
        server('article/update', {
            id: parseInt(element.id.substring(1)),
            pos: get_child_pos(element)
        });
    }
    unselect_article();
}



