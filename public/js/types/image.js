function add_image() {

    let url = '';
    let caption = '';
    let shadow = true;
    
    server('types/imageform', {
        pageid: pageid(),
        size: 128,
        url: url,
        caption: caption,
        shadow: shadow
    }).then(
        (resolve) => {
            add_form('image-form', resolve, 30);
        }
     );
}

function on_close_image() {
    remove_form('image-form');
}

function on_image_file(element) {
    
    const imageInput = element;
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];

        let folder = pageid()  ;
        upload_image(selectedImage, folder).then(
            (resolve) => {
                if (resolve.ok) {
                    document.getElementById('ai-save').removeAttribute('disabled');
                    document.getElementById('ai-image').src = image_page_path(resolve.content);
                    document.getElementById('ai-caption').select();
                }
            },
            (reject) => {
                error(reject);
            }
        );
    }
}


function add_new_image() {

    let article = selected_article();

    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'image',
        align: 'center',
        content: JSON.stringify( {
            src: filename_only(document.getElementById('ai-image').src),
            caption: document.getElementById('ai-caption').value,
            shadow: '1'

        })
    }).then(
        () => {
            get_content();
        }
    );
    on_close_image();
}

