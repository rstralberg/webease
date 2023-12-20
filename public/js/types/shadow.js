function toggle_shadow() {

    let section = selected_section();
    if( section ) {

        let img = section.querySelector('img');
        if( is_valid(img)) {
            toggle_class(img, 'shadow');
        }
    }
    
}