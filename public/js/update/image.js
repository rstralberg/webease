
function update_image(section) {
    /*
        <figure>
            <img 
                src="sites/km/4/ludvig-trumset.jpg" 
                width="NaNpx" 
                heigh="auto" 
                class="shadow">
            <figcaption>
                Set Nr 1
            </figcaption>
        </figure>
    */
    let element = section.querySelector('img');
    if( !is_valid(element)) return;
    let src = filename_only(element.src);
    let shadow = element.classList.contains('shadow');

    element = section.querySelector('figcaption');
    if( !is_valid(element)) return;
    let caption = element.innerText;

    
    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            src: src,
            caption: caption,
            shadow: shadow

        })
    });
}
