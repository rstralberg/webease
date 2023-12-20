function edit_settings() {

    server('settings/edit', {}).then(
        (resolve) => {
            add_form('edit-settings-form', resolve, 35);
        },
        (reject) => {
            error(reject);
        }
    );
}

function settings_theme_selected() {

}

function settings_logo_selected() {

    const imageInput = document.getElementById('settings-file');
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];

        upload_image(selectedImage, '').then(
            (resolve) => {
                if (resolve.ok) {
                    document.getElementById('settings-image').src = image_path('',resolve.content);
                }
            },
            (reject) => {
                error(reject);
            }
        );
    }
}

function settings_save() {

    server('settings/save', {
        title: document.getElementById('settings-name').value,
        owner: document.getElementById('settings-owner').value,
        email: document.getElementById('settings-email').value,
        logo:  filename_only(document.getElementById('settings-image').src),
        theme: document.getElementById('settings-theme').value
    }).then(
        (resolve) => {
            get_navbar()
        },
        (reject) => { error(reject); }
    );
}

function close_settings() {
    remove_form('edit-settings-form');
}

