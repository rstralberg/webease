
// Entry point called from server
function index(pageid) {


    let username = get_cookie(key() + '/user');
    if (username !== '') {
        server('user/get', {
            username: username
        }).then(
            (resolve) => {
                let user = JSON.parse(resolve);
                set_username(user.username);
                set_adm(user.adm);

                let theme = get_cookie(key() + '/theme');
                if( theme !== '') {
                    get_theme(theme);
                }
                start();
            });
    } 
    else {
        let theme = get_cookie(key() + '/theme');
        if( theme !== '') {
            get_theme(theme);
        }
        start();
    }
}

function start() {
    
    show_user_tools();
    show_admin_tools();
    get_navbar();
    get_title();
    get_content();
    get_footer();
}

function on_toggle_comments(element) {
    let comments = document.querySelector('.comments-content');
    comments.style.display = comments.style.display === 'none' ? 'block' : 'none';

    if (comments.style.display !== 'none') {
        get_comments(pageid());
    }
}


