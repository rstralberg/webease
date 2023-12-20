function align_right() {
    let element = selected_section()?selected_section():selected_article();
    if( element  ) 
    {
        element.style.justifyContent = 'right';
    }
}
