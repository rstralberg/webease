
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
    let element = section.querySelector('iframe');
    if( !is_valid(element)) return;

    let url = element.src;
    let splitter = '';
    if( url.includes('/track/')) {
        splitter = 'track/';
    } else if ( url.includes('/episode/')) {
        splitter = 'episode/';
    }

    let value = url.split(splitter);
    if( value.lenght < 2 ) return;
    
    let track = value[1].split('?');
    if( track.lenght < 2 ) return;
    track = track[0];

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            track: track,
            splitter: splitter
        })
    });
}
