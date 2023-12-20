

function simple(id, title, label, value, callback,  width=49 ) {

    server('forms/simple', {
        title: title, 
        label: label,
        value: value,
        callback: callback,
        formId: id
    }).then(
        (resolve) => {
            add_form(id, resolve, width);
        }
    );
}

function close_simple(id) {
    remove_form(id);
}
