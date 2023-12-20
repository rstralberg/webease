function on_rename_page() {
    simple('rename-page', 'Nytt namn', 'Ange sidans namn', '', 'on_page_rename' );
}

function on_page_rename(element) {
    let new_title = element.value;
    remove_form('rename-page');

    server('page/rename', {
        pageid: pageid(),
        title: new_title
    }).then(
        () => {
            get_navbar();
        }
    );
}


