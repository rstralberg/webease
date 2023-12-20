

function logout() {

    server('user/logout', {
        username: username()
    }).then(
        (resolve) => {
            add_form('logout-form', resolve, 30 );
        }
    );
}


function on_logout() {
    remove_form('logout-form');
    set_username('');
    set_adm(false);
    set_cookie(key()+'/user','');

    get_content();
    get_navbar();
    get_title();

}

function on_logout_close() {
    remove_form('logout-form');
}
