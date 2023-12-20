
function add_list() {

    server('types/listform', { } ).then(
        (resolve) => {
            add_form('list-form', resolve);
        }
    );
}

function close_list() {
    remove_form('list-form');
}

function save_list() {
    
    let article = selected_article();
    
    let list = document.getElementById('list');

    let items = new Array();
    for(let i=0; i < list.childElementCount; i++) {
        items.push(list.children[i].innerText);
    }
    
    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        align: 'left',
        type: 'list',
        content: JSON.stringify( {
            style: document.getElementById('list-type').value,
            items: items
        })
    }).then(
        () => {
            get_content();
        }
    );
    remove_form('list-form');
}

function update_list_type(e) {
    let list = document.getElementById('list');
    list.style.listStyle = e.value;
}

function add_to_list() {
    let text = document.getElementById('list-item').value;
    let list = document.getElementById('list');
    let li = document.createElement('li');
    li.innerText = text;
    list.appendChild(li);

}


function remove_from_list() {
    let text = document.getElementById('list-item').value;
    let list = document.getElementById('list');
    for( let i=0; i < list.childElementCount; i++)  {
        if( list[i].innerText === text) {
            list.remove(list[i]);
            break;
        }
    }
}
    
