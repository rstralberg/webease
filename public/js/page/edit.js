
function edit_pages() {

    server('page/edit', {}).then(
        (resolve) => {
            add_form('edit-pages-form', resolve, 35);
        }
    )
}

function on_close_editpages() {
    remove_form('yn-delete-sel-page');
    remove_form('edit-pages-form');
}

function on_edit_page_selected(element) {

    let pageid = element.value;

    let pagelist = document.getElementById('edit-pages-pagelist');
    document.getElementById('edit-pages-selected').value = 'p'+pageid;
    pagelist.innerHTML = '';

    server('page/menu', {}).then(
        (resolve) => {
            let pages = JSON.parse(resolve);
            pages.forEach(page => {
                let li = document.createElement('li');
                li.value = page.id;
                li.id = 'p'+page.id;
                li.innerText = page.title;
                if( page.id  === pageid ) {
                    document.getElementById('edit-pages-selected-name').value = page.title;
                    li.classList.add('selected-listitem');
                }
                pagelist.appendChild(li);
            });
            enable_element('edit-pages-delete', true);
            enable_element('edit-pages-rename', true);
        },
        (reject) => {
            error(reject);
        }
    );
}

function on_edit_new_pagename(element) {
    enable_element('edit-pages-rename-button', element.value.length > 0);
}

function on_edit_change_pagename() {
    server('page/rename', {
        pageid: parseInt(document.getElementById('edit-pages-selected').value.substring(1)),
        title: document.getElementById('edit-pages-rename').value
    }).then( 
        () => {
            get_navbar();
        }
    );

}

function on_edit_parent_selected(element) {
    let parent = element.value;
    let id = document.getElementById('edit-pages-selected').value.substring(1);

    server('page/update', {
        pageid: parseInt(id) ,
        cols: ['parentId'],
        values: [parseInt(parent)] }).then(
        () => {
            get_navbar();
        }
    );

}

function on_page_move_up() {

    let selected_pageid = document.getElementById('edit-pages-selected').value;
    let ul = document.getElementById('edit-pages-pagelist');
    if (ul === null)
        return;
    
    let moved = false;
    // find position
    let newList = new Array();
    let pos = 0;
    for (let i = 0; i < ul.childElementCount; i++) {
        newList.push(ul.children[i]);
        if (ul.children[i].id === selected_pageid) {
            pos = i;
        }
    }
    // swap
    if (pos > 0) {
        let temp = newList[pos - 1];
        newList[pos - 1] = newList[pos];
        newList[pos] = temp;
        moved = true;
    }
    // rebuild
    ul.innerHTML = '';
    for (let i = 0; i < newList.length; i++) {
        let li = document.createElement('li');
        li.id = newList[i].id;
        li.style.listStyle = 'none';
        if (newList[i].id === selected_pageid) {
            li.classList.add('selected-listitem');
        }
        li.innerText = newList[i].innerText;
        ul.appendChild(li);
    }
    if (moved) {
        let positions = new Array();
        for (pos = 0; pos < ul.childElementCount; pos++) {
            positions.push({
                id: parseInt(ul.children[pos].id.substring(1)),
                pos: pos
            });
        }
        update_page_positions(positions);
        get_navbar();

    }
}

function on_page_move_down() {

    let selected_pageid = document.getElementById('edit-pages-selected').value;
    let ul = document.getElementById('edit-pages-pagelist');
    if (ul === null)
        return;
    
    let moved = false;
    // find position
    let newList = new Array();
    let pos = 0;
    for (let i = 0; i < ul.childElementCount; i++) {
        newList.push(ul.children[i]);
        if (ul.children[i].id === selected_pageid) {
            pos = i;
        }
    }
    // swap
    if (pos < ul.childElementCount - 1) {
        let temp = newList[pos + 1];
        newList[pos + 1] = newList[pos];
        newList[pos] = temp;
        moved = true;
    }
    // rebuild
    ul.innerHTML = '';
    for (let i = 0; i < newList.length; i++) {
        let li = document.createElement('li');
        li.id = newList[i].id;
        li.style.listStyle = 'none';
        if (newList[i].id === selected_pageid) {
            li.classList.add('selected-listitem');
        }
        li.innerText = newList[i].innerText;
        ul.appendChild(li);
    }
    if (moved) {
        let positions = new Array();
        for (pos = 0; pos < ul.childElementCount; pos++) {
            positions.push({
                id: parseInt(ul.children[pos].id.substring(1)),
                pos: pos
            });
        }
        update_page_positions(positions);
        get_navbar();
            
    }
}

function on_delete_selected_page() {
    let selected_page = document.getElementById('edit-pages-selected').value;
    if( is_valid(selected_page) ) {
        yesno( 'yn-delete-sel-page', 'Radera sida', 
            'Är du säker på att du vill radera sidan "' + 
            document.getElementById('edit-pages-selected-name').value + '"', 
            'yes_delete_the_page', 'close_yesno');
    }
}

function yes_delete_the_page() {
    remove_form('yn-delete-sel-page');
    server('page/delete', {
        pageid: document.getElementById('edit-pages-selected').value.substring(1)
    }).then(
        () => {
            get_navbar();
            
            server('page/menu', {}).then(
                (resolve) => {
                    let pages = JSON.parse(resolve);
                    let select = document.getElementById('edit-pages-pages');
                    select.innerHTML = '';
                    
                    let option = document.createElement('option');
                    option.value = 'none';
                    option.innerText = 'Välj!'
                    select.appendChild(option);
                    pages.forEach(page => {
                        let option = document.createElement('option');
                        option.value = page.id;
                        option.innerText = page.title;
                        select.appendChild(option);
                    });
                },
                (reject) => {
                    error(reject);
                }
            );
        }
    );    
}

function update_page( pageid, cols, values ) {

    server('page/update', {
        pageid: pageid,
        cols: cols,
        values: values
    }).then(
        (resolve) => {
            let page = JSON.parse(resolve);
            set_page(page);
        },
        (reject) => {
            error(reject);
        }
    )
}

function update_page_positions(pos_array)
{
    pos_array.forEach(item => {
        update_page( item.id, ['pos'], [item.pos] );
    });
}

function set_page(page) {
    let eid = document.querySelector('#_page_id');
    if( !is_valid(eid)) return ;
    eid.value = page.id;

    let et = document.querySelector('#_page_title');
    if( !is_valid(et)) return ;
    et.value = page.title;

    set_page_public(page.isPublic);
}

function set_page_public( pub ) {
    let e = document.querySelector('#_page_public');
    if( !is_valid(e)) return ;

    e.value = pub ? 'true' : 'false';

}
