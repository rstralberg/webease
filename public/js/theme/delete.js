
function delete_theme() {

    let e_theme = document.getElementById('theme-select');
    if( !is_valid(e_theme)) return;

    server('theme/delete', {
        theme: e_theme.value
    }).then(
        () => {
            let e_theme = document.getElementById('theme-select');
            for(let i=0; i < e_theme.childElementCount; i++) {
                if( e_theme.children[i].value === e_theme.value) {
                    e_theme.removeChild(e_theme.children[i]);
                    break;
                }
            }
        }
    );
}