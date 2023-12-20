function add_soundcloud() {

    server('types/soundcloudform', {}).then(
        (resolve) => {
            add_form('soundcloud-form', resolve);
        }
    )
}

function on_close_soundcloud() {
    remove_form('soundcloud-form');
}

function on_soundcloud_pasted(element) {

    // <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" 
    // src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
    // 1434718045
    // &color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&
    // show_reposts=false&show_teaser=true&visual=true"></iframe>
    // <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;
    // overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: 
    // Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;
    // font-weight: 100;">

    let value = element.value.split('tracks/');
    if( value.lenght < 2 ) return;
    
    let track = value[1].split('&');
    if( track.lenght < 2 ) return;
    track = track[0];

    let html='<iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" ';
    html += 'src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
    html += track
    html += '&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&';
    html += 'show_reposts=false&show_teaser=true&visual=true"></iframe>';
    html += '<div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;';
    html += 'overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: ';
    html += 'Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;';
    html += 'font-weight: 100;">';

    document.getElementById('sc-frame').innerHTML = html;
    document.getElementById('sc-save-button').focus();
}

function add_new_soundcloud() {
    
    let article = selected_article();

    let element = document.getElementById('sc-url');
    let value = element.value.split('tracks/');
    if( value.lenght < 2 ) return;
    
    let track = value[1].split('&');
    if( track.lenght < 2 ) return;
    track = track[0];

    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'soundcloud',
        align: 'center',
        content: JSON.stringify( {
            track: track
        })
    }).then(
        () => {
            get_content();
        }
    )
    remove_form('soundcloud-form');
}

