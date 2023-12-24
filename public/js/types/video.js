function add_movie() {

    server('types/videoform', {
        pageid: pageid(),
        src: '',
        type: 'mp4'
    }).then(
        (resolve) => {
            add_form('video-form', resolve);
        }
    );
}

function video_selected(element) {
    const videoInput = element;
    if (videoInput === null) return;
    if (videoInput.files === null) return;
    if (videoInput.files.length === 0) return;

    const selectedVideo = videoInput.files[0];
    upload_movie(selectedVideo).then(
        (resolve) => {
            if (resolve.ok) {
                let video = document.createElement('video');
                video.width = 400;
                video.controls = true;
                
                let source = document.createElement('source');
                source.type = 'video/mp4';
                source.src = resolve.content;
                
                video.appendChild(source);
         
                let player = document.getElementById('m-player');
                player.innerHTML = '';
                player.appendChild(video);
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

function add_new_video() {
    let article = selected_article();

    let player = document.getElementById('m-player');
    let source = player.querySelector('source');


    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'video',
        align: 'center',
        content: JSON.stringify( {
            src: filename_only(source.src),
            type: source.type
        })
    }).then(
        () => {
            get_content();
        }
    );
    close_video();
}

function close_video() {
    remove_form('video-form');
}



function update_video(section) {

    let video = section.querySelector('video');
    let source = video.querySelector('source');
    
    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify({
            src: filename_only(source.src),
            type: source.type
        })
    });
}