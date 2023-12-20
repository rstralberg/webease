function selection_to_bold() {
    let text = get_selected_text();
    if (text === '') {
        popup('Fet stil', 'Ingen text är markerad');
        return;
    }
    toggle_tag('strong');
}
