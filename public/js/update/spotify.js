
function update_spotify(section) {
    /*
        <iframe 
            style="border-radius:12px" 
            src="https://open.spotify.com/embed/track/<TRACK>?utm_source=generator" 
            width="100%" 
            height="352" 
            frameborder="0" 
            allowfullscreen="" 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
            loading="lazy">
        </iframe>
    */
    let iframe = section.querySelector('iframe');
    if( !is_valid(iframe)) return;

    let src = iframe.src;
    src = src.split('track/')[1];
    src = src.split('?')[0];

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            track: src
        })
    });
}
