function add_youtube() {

    server('types/youtubeform', {}).then(
        (resolve) => {
            add_form('youtube-form', resolve);
        }
    )
}

function on_close_youtube() {
    remove_form('youtube-form');
}

function on_youtube_pasted(element) {
    // https://youtu.be/FMnVIKJJldE?si=OQCgAJIQ1MVFzvzV
    let track = filename_only(element.value);
    
    let html = '<iframe width="560" height="315" ';
    html += 'src="https://www.youtube.com/embed/';
    html += track;
    html += '" title="YouTube video player" frameborder="0" ';
    html += 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; ';
    html += 'gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

    document.getElementById('yt-frame').innerHTML = html;
    document.getElementById('yt-save-button').focus();
}

function on_save_youtube() {
    
    let article = selected_article();
    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        align: 'center',
        type: 'youtube',
        content: JSON.stringify( {
            track: filename_only(document.getElementById('yt-url').value)
        })
    }).then(
        (id) => {
            get_content();
        }
    );
    remove_form('youtube-form');
}

