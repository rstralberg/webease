function align_left() {
    let element = selected_section()?selected_section():selected_article();
    if( element  ) 
    {
        element.style.justifyContent = 'left';
    }
}
