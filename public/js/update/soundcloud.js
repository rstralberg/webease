
function update_soundcloud(section) {
    /*
        <iframe 
            width="100%" height="300" 
            scrolling="no" 
            frameborder="no" 
            allow="autoplay" 
            src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<TRACK>
            &amp;color=%23ff5500&amp;auto_play=false
            &amp;hide_related=false&amp;
            show_comments=true&amp;show_user=true&amp;show_reposts=false
            &amp;show_teaser=true&amp;visual=true">
    </iframe> */
    let iframe = section.querySelector('iframe');
    if( !is_valid(iframe)) return;

    let src = iframe.src;
    src = src.split('tracks/', src)[1];
    src = src.split('&', src)[0];

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            track: src
        })
    });
}
