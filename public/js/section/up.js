function move_selected_up() {

    let element = selected_section()?selected_section():select_article();
    if (element === false) return;

    if (element.previousElementSibling) {
        element.parentNode.insertBefore(element, element.previousElementSibling);

        if (element.getAttribute('type') === 'article')
            update_article_positions(element.parentElement);
        else
            update_section_positions(element.parentElement);
    }
}


