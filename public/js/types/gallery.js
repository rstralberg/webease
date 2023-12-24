
function add_gallery() {
    server('types/galleryform', {}).then(
        (resolve) => {
            add_form('gallery-form', resolve, parseInt(get_style('contentW')));
        }
    );

}

function gallery_image_selected(element) {

    const imageInput = element;
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];
        let folder = pageid();
        upload_image(selectedImage, folder).then(
            (resolve) => {
                if (resolve.ok) {
                    let img = document.createElement('img');
                    img.addEventListener('load', (e) => {
                        let container = document.getElementById('g-gallery');
                        let figure = document.createElement('figure');
                        add_class(figure, 'gallery-figure');
                        figure.appendChild(img);
                        container.appendChild(figure);

                        figure.addEventListener('click', (e) => {
                            let container = document.getElementById('g-gallery');
                            let figs = container.querySelectorAll('figure');
                            for (let i = 0; i < figs.length; i++) {
                                figs[i].style.border = 'none';
                            }
                            figure.style.border = '2px solid red';
                        });

                    });
                    img.src = image_page_path(resolve.content);

                }
            }
        );
    }
}

function edit_gallery_image_clicked(element) {

    let figs = element.parentElement.querySelectorAll('figure');
    for (let i = 0; i < figs.length; i++) {
        figs[i].style.border = 'none';
    }
    element.style.border = '2px solid red';

}
function gallery_shadow_toggle(element) {
    let container = document.getElementById('g-gallery');
    toggle_class(container, 'shadow');
    let shadow = container.classList.contains('shadow');

    let figs = element.parentElement.querySelectorAll('figure');
    for (let i = 0; i < figs.length; i++) {
        let img = figs[i].querySelector('img');
        if (shadow && !img.classList.contains('shadow')) {
            add_class(img, 'shadow');
        }
        else if (!shadow && img.classList.contains('shadow')) {
            remove_class(img, 'shadow');
        }
    }

}

function remove_gallery_image() {
    let container = document.getElementById('g-gallery');
    let figs = container.querySelectorAll('figure');
    for (let i = 0; i < figs.length; i++) {
        let fig = figs[i];
        if (fig.style.border === '2px solid red') {
            container.removeChild(fig);
            break;
        }
    }

}

function close_gallery() {
    remove_form('gallery-form');
}


function save_gallery() {

    let article = selected_article();

    let container = document.getElementById('g-gallery');
    let imgs = container.querySelectorAll('img');
    let images = new Array();
    for (let i = 0; i < imgs.length; i++) {
        images.push(filename_only(imgs[i].src));
    }

    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'gallery',
        align: 'center',
        content: JSON.stringify({
            images: images,
            shadow: '1'
        })
    }).then(
        () => {
            get_content();
        }
    );

    remove_form('gallery-form');
}

function edit_gallery(section) {

    let container = section.querySelector('.gallery-container');
    let shadow = container.classList.contains('shadow');
    let imgs = section.querySelectorAll('img');
    let images = new Array();
    for (let i = 0; i < imgs.length; i++) {
        images.push(filename_only(imgs[i].src));
    }

    server('types/editgallery', {
        id: section.id,
        pageid: pageid(),
        images: images,
        shadow: shadow
    }).then(
        (resolve) => {
            add_form('edit-gallery-form', resolve, parseInt(get_style('contentW')));
        }
    );
}

function edit_gallery_image_selected(element) {

    const imageInput = element;
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];
        let folder = pageid();
        upload_image(selectedImage, folder).then(
            (resolve) => {
                if (resolve.ok) {
                    let img = document.createElement('img');
                    img.addEventListener('load', (e) => {
                        let container = document.getElementById('eg-gallery');
                        let figure = document.createElement('figure');
                        add_class(figure, 'gallery-figure');
                        figure.appendChild(img);
                        container.appendChild(figure);

                        figure.addEventListener('click', (e) => {
                            let container = document.getElementById('eg-gallery');
                            let figs = container.querySelectorAll('figure');
                            for (let i = 0; i < figs.length; i++) {
                                figs[i].style.border = 'none';
                            }
                            figure.style.border = '2px solid red';
                        });

                    });
                    img.src = image_page_path(resolve.content);

                }
            }
        );
    }
}

function edit_gallery_shadow_toggle(element) {
    let container = document.getElementById('eg-gallery');
    toggle_class(container, 'shadow');
    let shadow = container.classList.contains('shadow');

    let figs = container.querySelectorAll('figure');
    for (let i = 0; i < figs.length; i++) {
        let img = figs[i].querySelector('img');
        if (shadow && !img.classList.contains('shadow')) {
            add_class(img, 'shadow');
        }
        else if (!shadow && img.classList.contains('shadow')) {
            remove_class(img, 'shadow');
        }
    }

}

function remove_edit_gallery_image() {
    let container = document.getElementById('eg-gallery');
    let figs = container.querySelectorAll('figure');
    for (let i = 0; i < figs.length; i++) {
        let fig = figs[i];
        if (fig.style.border === '2px solid red') {
            container.removeChild(fig);
            break;
        }
    }

}

function close_edit_gallery() {
    remove_form('edit-gallery-form');
}


function save_edit_gallery() {

    let section = selected_section();

    let container = document.getElementById('eg-gallery');
    let imgs = container.querySelectorAll('img');
    let images = new Array();
    for (let i = 0; i < imgs.length; i++) {
        images.push(filename_only(imgs[i].src));
    }

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify({
            images: images,
            shadow: document.getElementById('eg-shadow').checked
        })
    }).then(
        () => {
            get_content();
        }
    );

    remove_form('edit-gallery-form');
}

function update_gallery(section) {

    let container = section.querySelector('figure');
    let imgs = container.querySelectorAll('img');
    let images = new Array();
    for (let i = 0; i < imgs.length; i++) {
        images.push(filename_only(imgs[i].src));
    }

    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify({
            images: images,
            shadow: container.classList.contains('shadow')
        })
    });
}