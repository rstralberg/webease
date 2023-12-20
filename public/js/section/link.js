function add_weblinik() {

    let text = get_selected_text();
    if (text === '') {
        popup('Länk', 'Ingen text är markerad');
        return;
    }
    
    let e = add_tag('a');
    e.href = 'https://';
    e.id = 'temp-link';
    server('types/linkform', {
        text: text
    }).then(
        (resolve) => {
            add_form('link-form', resolve);
        }
    );
}

function on_save_weblink() {
    let section = selected_section();

    let a = document.getElementById('temp-link');
    a.removeAttribute('id');
    a.target = '_blank';
    a.href = document.getElementById('wl-link').value;

    remove_form('link-form');

    update_selected(section);
}

function on_close_weblink() {
    remove_form('link-form');
}

    

