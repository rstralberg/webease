function move_selected_down() {

    let element = selected_section()?selected_section():select_article();
    if( element === false ) return;

    if (element.nextElementSibling) {
        element.parentNode.insertBefore(element.nextElementSibling, element);

        if (element.getAttribute('type') === 'article')
            update_article_positions(element.parentElement);
        else
            update_section_positions(element.parentElement);
    }
}