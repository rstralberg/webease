
function on_login() {

    if( window.innerWidth <= 600 ) return;

    if( username() !== '' ) {
        logout();
        return;
    }
    
    server('user/login', {}).then(
        (resolve) => {
            add_form('login-form', resolve, 30 );
        }
    )
}

function on_user_login() {

    server('user/login_apply', {
        username: document.getElementById('li-username').value,
        password: document.getElementById('li-password').value
    }).then(
        (resolve) => {
            let user = JSON.parse(resolve);
            set_username(user.username);
            set_adm(user.adm === '1');
            set_cookie(key() +'/user', user.username);
            on_close_login();
            get_navbar();
            get_content();
            get_title();
        },
        (reject) => {
            on_close_login();
        }
    );

}

function on_close_login() {
    remove_form('login-form');
}

