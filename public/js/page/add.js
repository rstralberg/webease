function add_page() {

    server('page/add', {}).then(
        (resolve) => {
            add_form('addpage-form', resolve, 35);
        }
    )
}

function on_close_new_page() {
    remove_form('addpage-form');
}

function on_save_new_page() {
    let title = document.getElementById('addpage-title').value;
    let type = document.getElementById('addpage-type').value;

    let isParent = false;
    let parentId = 0 ;
    if( type === 'top') {
        isParent = false;
        parentId = 0 ;
    } 
    else if ( type === 'parent') {
        isParent = true;
        parentId = 0 ;
    } 
    else {
        isParent = false;
        parentId = parseInt(type) ;
    }

    server('page/new_page', {
        title: title,
        isParent: isParent,
        parentId: parentId,
        username: username()
    }).then(
        (resolve) => { 
            let pg = JSON.parse(resolve);
            window.location = '/' + key() + '?p=' + pg.id;
        }
    );

}