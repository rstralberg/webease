
function entering_section(element) {

    let prev = selected_section();
    if( prev && prev.id === element.id ) return;

    if (prev) leaving_section(prev);

    select_section(element);

    add_class(element, 'active-section');

    let type = element.getAttribute('type');
    enable_add_tool(false);
    enable_article_tools(false);
    enable_section_tools(true);
    enable_text_tools(type === 'text');
    enable_shadow_tool(type === 'image');
    enable_link_tool(type === 'text');
    enable_move_tools(true);
    enable_delete_tool(true);
    if (type === 'text' || type === 'title' || type === 'list') {
        element.contentEditable = true;
    }
    else if (type === 'image' || type === 'audio') {
        let figcaption = element.querySelector('figcaption');
        if (is_valid(figcaption)) {
            figcaption.contentEditable = true;
        }
    }

}

function leaving_section() {

    let element = selected_section();
    if (element) {
        remove_class(element, 'active-section');

        let type = element.getAttribute('type');
        if (type === 'image') {
            let img = element.querySelector('img');
            if (is_valid(img)) {
                img.removeEventListener('mousewheel', (e) => { });
            }
        }
    }

    enable_add_tool(false);
    enable_article_tools(false);
    enable_section_tools(false);
    enable_text_tools(false);
    enable_shadow_tool(false);
    enable_link_tool(false);
    enable_move_tools(false);
    enable_delete_tool(false);

    if (element) {
        let type = element.getAttribute('type');
        if (type === 'text' || type === 'title' || type === 'list') {
            element.contentEditable = false;
        }
        if (type === 'image' | type === 'audio') {
            let figcaption = element.querySelector('figcaption');
            if (is_valid(figcaption)) {
                figcaption.contentEditable = false;
            }
        }
        let func = 'update_' + type;
        if (typeof window[func] === 'function') {
            window[func](element);
        }
    }
    unselect_section();
}

