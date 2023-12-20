function delete_page() {

    yesno('yn-delpage', 'Radera sidan!', 'Är du säker?', 'delete_page_yes', 'delete_page_no' );
}

function delete_page_yes() {
    remove_form('yn-delpage');

    server('page/delete', {
        pageid: pageid()
    }).then(
        () => {
            get_navbar();
            get_content();
            window.location = '/' + key() ;
        }
    )
}

function delete_page_no() {
    remove_form('yn-delpage');
}

