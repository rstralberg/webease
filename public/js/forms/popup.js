
function popup(title, message, width=40, isError = false ) {

    server('forms/popup', {
        title: title, 
        message: message,
        isError: isError
    }).then(
        (resolve) => {
            add_form('popup', resolve, width);
        }
    )
}



