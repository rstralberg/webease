function edit_users() {

    server('user/edit', {}).then(
        (resolve) => {
            add_form('edit-users-form', resolve, 45);
        }
    );
}

function edit_users_selected() {

    let selection = document.getElementById('edit_users_list').value;
    if (selection === 'none') return;
    if (selection === 'add') {

        document.getElementById('edit_users_image').src = image_path('users', 'avatar.png');
        document.getElementById('edit_users_username').value = '?';
        document.getElementById('edit_users_fullname').value = '?';
        document.getElementById('edit_users_email').value = '?';

        enable_element('edit_users_file', true);
        enable_element('edit_users_username', true);
        enable_element('edit_users_fullname', true);
        enable_element('edit_users_email', true);
        enable_element('edit_users_save_new', false);
        enable_element('edit_users_save', false);
        enable_element('edit_users_password', true);
        enable_element('edit_users_delete', false);

        return;
    }

    server('user/get', {
        username: document.getElementById('edit_users_list').value
    }).then(
        (resolve) => {
            let user = JSON.parse(resolve);
            document.getElementById('edit_users_image').src = image_user_path(user.picture);
            document.getElementById('edit_users_username').value = user.username;
            document.getElementById('edit_users_fullname').value = user.fullname;
            document.getElementById('edit_users_email').value = user.email;
            
            enable_element('edit_users_file', true);
            enable_element('edit_users_username', true);
            enable_element('edit_users_fullname', true);
            enable_element('edit_users_email', true);
            enable_element('edit_users_save_new', false);
            enable_element('edit_users_save', true);
            enable_element('edit_users_password', true);
            enable_element('edit_users_delete', user.username !== 'admin');
        }
    );

}

function edit_users_imgsrc_selected() {

    const imageInput = document.getElementById('edit_users_file');
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];

        upload_image(selectedImage, 'users').then(
            (resolve) => {
                if (resolve.ok) {
                    document.getElementById('edit_users_image').src = image_user_path(resolve.content);
                }
            }
        );
    }
}

function on_edit_user_password() {
    password('edit_users_password_save');
}

function edit_users_password_save(pwd_id) {
    document.getElementById('edit_users_hidden_password').value = document.getElementById(pwd_id).value;
    close_password();
    enable_element('edit_users_save_new', true);
}

function pw_close() {
    remove_form('password-form');
}

function on_edit_user_save() {

    server('user/update', {
        username: document.getElementById('edit_users_username').value,
        fullname: document.getElementById('edit_users_fullname').value,
        email: document.getElementById('edit_users_email').value,
        picture: filename_only(document.getElementById('edit_users_image').src),
        password: document.getElementById('edit_users_hidden_password').value.length > 0 ? document.getElementById('edit_users_hidden_password').value.length : ''
    }).then(
        () => {
            enable_element('edit_users_save_new', false);
            enable_element('edit_users_save', true);
        },
    )

}

function edit_user_fill_list() {

    server('users/get',{}).then(
        (resolve) => {
            let users = JSON.parse(resolve);

            let select = document.getElementById('edit_users_list');
            select.innerHTML = '';
            
            let option = document.createElement('option');
            option.value = 'none';
            option.innerText = 'Välj!';
            select.appendChild(option);

            option = document.createElement('option');
            option.value = 'add';
            option.innerText = 'Lägg till ny användare!';
            select.appendChild(option);
            
            users.forEach(user => {
                let option = document.createElement('option');
                option.value = user.username;
                option.innerText = user.fullname;
                select.appendChild(option);
            });

            select.selectedIndex = 0;

        }
    );
}


function on_edit_user_save_new() {

    server('user/add', {
        username: document.getElementById('edit_users_username').value,
        fullname: document.getElementById('edit_users_fullname').value,
        email: document.getElementById('edit_users_email').value,
        picture: filename_only(document.getElementById('edit_users_image').src),
        password: document.getElementById('edit_users_hidden_password').value
    }).then(
        () => {
            edit_user_fill_list();
            enable_element('edit_users_save_new', false);
            enable_element('edit_users_save', true);
        },
        (reject) => {
            error(reject);
        }
    );
}

function yes_delete_user() {
    let username = document.getElementById('edit_users_username').value;
    remove_form('yn-delete-user');
    server('user/delete', {
        username: username
    }).then(
        () => {
            edit_user_fill_list();
            document.getElementById('edit_users_image').src =  image_path('users', 'avatar.png');
            document.getElementById('edit_users_username').value = '';
            document.getElementById('edit_users_fullname').value = '';
            document.getElementById('edit_users_email').value = '';
            enable_element('edit_users_file', false);
            enable_element('edit_users_username', false);
            enable_element('edit_users_fullname', false);
            enable_element('edit_users_email', false);
            enable_element('edit_users_save_new', false);
            enable_element('edit_users_save', false);
            enable_element('edit_users_password', false);
            enable_element('edit_users_delete', false);

        }
    )
}

function no_delete_user() {
    remove_form('yn-delete-user');
}

function on_edit_user_delete() {
    let fullname = document.getElementById('edit_users_fullname').value;
    yesno('yn-delete-user', 'Radera', 'Är du säker på att du vill radera "' + fullname + '"?', 'yes_delete_user', 'no_delete_user');
}

function on_close_editusers() {
    remove_form('edit-users-form');
}

