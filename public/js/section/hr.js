function add_line() {

    let section = selected_section();
    if( section ) {
        section.innerHTML += '<hr>';
        update_selected(section);
    }
}
