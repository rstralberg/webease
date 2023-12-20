function add_spotify() {

    server('types/spotifyform', {}).then(
        (resolve) => {
            add_form('spotify-form', resolve);
        }
    )
}

function on_close_spotify() {
    remove_form('spotify-form');
}

function on_spotify_pasted(element) {

    let value = element.value.split('track/');
    if( value.lenght < 2 ) return;
    
    let track = value[1].split('?');
    if( track.lenght < 2 ) return;
    track = track[0];

    let html = '<iframe style="border-radius:12px" ';
    html += 'src="https://open.spotify.com/embed/track/';
    html += track;
    html += '?utm_source=generator" width="100%" height="352" ';
    html += 'frameBorder="0" allowfullscreen="" allow="autoplay; ';
    html += 'clipboard-write; encrypted-media; fullscreen; ';
    html += 'picture-in-picture" loading="lazy"></iframe>';

    document.getElementById('sp-frame').innerHTML = html;
    document.getElementById('sp-save-button').focus();
}

function add_new_spotify() {
    
    // https://open.spotify.com/episode/59ecJNh39cRbaHzck0FJqK?si=70061b9b93864217

    let article = selected_article();

    let element = document.getElementById('sp-url');
    let value = element.value.split('track/');
    if( value.lenght < 2 ) return;
    
    let track = value[1].split('?');
    if( track.lenght < 2 ) return;
    track = track[0];

    remove_form('spotify-form');

    
    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        align: 'center',
        type: 'spotify',
        content: JSON.stringify( {
            track: track
        })
    }).then(
        () => {
            get_content()
        }
    );

}

