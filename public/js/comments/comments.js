
function get_comments(pageid) {

    server('comments/get', {
        pageid: pageid
    }).then(
        (resolve) => {
            let container = document.getElementById('comments-container');
            container.innerHTML = resolve;
        }
    );
}

function on_add_comment() {

    server('comments/add', {
        username: username()
    }).then(
        (resolve) => {
            add_form('add-comment', resolve);
        }
    )
}

function on_comment_title(element) {
    enable_element('comm-save', element.value !== '');
}

function on_close_comment() {
    remove_form('add-comment');
}

function on_save_comment() {
    let picture = document.getElementById('comm-image').src;
    let title =  document.getElementById('comm-title').value;
    let comment = document.getElementById('comm-comment').innerHTML;
    server('comments/save', {
        pageid: pageid(),
        username: username(),
        picture: picture,
        title: title,
        comment: comment,
    }).then(
        () => {
            get_comments(pageid());
        }
    );
}

function delete_comment() {
    
}