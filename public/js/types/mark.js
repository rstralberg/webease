function mark_selected() {
    let text = get_selected_text();
    if (text === '') {
        popup('Markering', 'Ingen text är markerad');
        return;
    }
    toggle_tag('mark');
}
