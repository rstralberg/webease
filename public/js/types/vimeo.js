function add_vimeo() {

    server('types/vimeoform', {}).then(
        (resolve) => {
            add_form('vimeo-form', resolve);
        }
    )
}

function on_close_vimeo() {
    remove_form('vimeo-form');
}

function on_vimeo_pasted(element) {
    // https://vimeo.com/782936967
    let track = filename_only(element.value);
    
    let html = '<iframe src="https://player.vimeo.com/video/';
    html += track;
    html += '?h=1c61046eef" ';
    html += 'width="640" height="351" ';
    html += 'frameborder="0" ';
    html += 'allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>';
    html += '</iframe>';

    document.getElementById('vi-frame').innerHTML = html;
    document.getElementById('vi-save-button').focus();
}

function on_save_vimeo() {
    
    let article = selected_article();
    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        align: 'center',
        type: 'vimeo',
        content: JSON.stringify( {
            track: filename_only(document.getElementById('vi-url').value)
        })
    }).then(
        (id) => {
            get_content();
        }
    );
    remove_form('vimeo-form');
}

