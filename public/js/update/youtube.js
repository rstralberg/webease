
function update_youtube(section) {
    /*
        <iframe 
            width="560" 
            height="315" 
            src="https://www.youtube.com/embed/<TRACK>?si=mx_E0ZpldamaAl5B" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; 
            autoplay; clipboard-write; encrypted-media; gyroscope; 
            picture-in-picture; web-share" allowfullscreen="">
        </iframe>    
    */
    let iframe = section.querySelector('iframe');
    if( !is_valid(iframe)) return;

    let src = iframe.src.split('embed/');
    src = src[1].split('?')[0];

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            track: src
        })
    });
}
