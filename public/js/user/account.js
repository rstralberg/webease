
function on_edit_account() {

    server('user/account', {
        username: username()
    }).then(
        (resolve) => {
            add_form('edit-account-form', resolve, 45);
        },
        (reject) => {
            error(reject);
        }
    );
}

function ea_image_selected() {

    const imageInput = document.getElementById('ea-file');
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];

        upload_image(selectedImage, 'users').then(
            (resolve) => {
                if (resolve.ok) {
                    document.getElementById('ea-image').src = image_path('users', resolve.content );
                    document.getElementById('ea-user-image').value = image_path('users', resolve.content );
                    // document.querySelector('.avatar-img').src = image_path('users', resolve.content);

                }
            },
            (reject) => {
                error(reject);
            }
        );
    }
}

function ea_password() {
    password('ea_save_password');
}

function ea_save_password(pwd_id) {
    document.getElementById('ea-user-password').value = document.getElementById(pwd_id).value;
    close_password();
}

function ea_save() {

    server('user/account_apply', {
        username: document.getElementById('ea-username').value,
        fullname: document.getElementById('ea-fullname').value,
        email: document.getElementById('ea-email').value,
        picture: filename_only(document.getElementById('ea-image').src),
        password: document.getElementById('ea-user-password').value.length > 0 ? document.getElementById('ea-user-password').value.length : ''
    }).then(
        (resolve) => {
            let user = JSON.parse(resolve);
            username() = user.username;
            is_adm() = user.adm;
            get_navbar();
            ea_close();
        },
        (reject) => {
            error(reject);
            ea_close();
        }
    )

}

function ea_close() {
    remove_form('edit-account-form');
}

