

function yesno(id, title, message, callback_yes, callback_no, width=40) {

    server('forms/yesno', {
        title: title, 
        message: message,
        yes: callback_yes,
        no: callback_no
    }).then(
        (resolve) => {
            add_form(id, resolve, width);
        }
    );
}

