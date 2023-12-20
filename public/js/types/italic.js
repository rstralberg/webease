function selection_to_italic() {

    let text = get_selected_text();
    if (text === '') {
        popup('Kursiv stil', 'Ingen text är markerad');
        return;
    }
    toggle_tag('em');
}
