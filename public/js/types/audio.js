function add_audio() {

    server('types/audioform', {}).then(
        (resolve) => {
            add_form('audio-form', resolve);
        }
    );
}

function audio_selected(element) {
    const audioInput = element;
    if (audioInput === null) return;
    if (audioInput.files === null) return;
    if (audioInput.files.length === 0) return;

    const selectedAudio = audioInput.files[0];
    upload_mp3(selectedAudio).then(
        (resolve) => {
            if (resolve.ok) {
                let form = document.getElementById('audio-form');
                let player = form.querySelector('#au-player');
                player.src = resolve.content;
                document.getElementById('au-src').value = player.src;
                enable_element('au-save-button', true);
            }
            else {
                error(resolve.content);
            }
        },
        (reject) => {
            error(reject);
        }
    );
}

function add_new_audio() {

    let article = selected_article();
    if (article===false ) return;

    let form = document.getElementById('audio-form');
    let caption = form.querySelector('#au-caption').value;


    server('add/section', {
        articleId: article.id,
        align: 'center',
        type:'audio',
        pos: article.childElementCount,
        content: JSON.stringify( {
            src: filename_only(document.getElementById('au-src').value),
            caption: caption
        })
    }).then(
        () => {
            get_content();
        }
    );
    close_audio();
}

function close_audio() {
    remove_form('audio-form');
}

