
function show_admin_tools(user) {
    if (user !== '' && is_adm()) {
        let tools = document.getElementById('admin-tools');
        if (is_valid(tools)) {
            tools.style.display = user.adm === '1' ? 'flex' : 'none';
        }
    }
}

function backup() {
    document.querySelector('body').style.background = 'red';
    server('utils/backup', {}).then(
        () => {
            document.querySelector('body').style.background = get_style('appBg');
        }
    )
}