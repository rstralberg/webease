
function error( message) {

    server('forms/error', {
        message: message,
    }).then(
        (resolve) => {
            add_form('error', resolve, 40);
        }
    )
}

