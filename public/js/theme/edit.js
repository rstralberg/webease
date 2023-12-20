function edit_themes() {
    server('theme/edit', {}).then(
        (resolve) => {
            add_form('theme-edit', resolve, 50);
        }
    );
}

function close_edit_theme() {
    remove_form('theme-edit');
}

function close_theme_editor() {
    remove_form('theme-editor');
}

function add_new_theme() {
    simple('new-theme', 'Nytt Tema', 'Ange temats namn', '', 'add_new_theme_name' );
}

function add_new_theme_name(element) {
    let name = element.value;
    remove_form('new-theme');
    server('theme/clone', {
        source: get_style('theme'),
        target: name
    }).then( 
        (resolve) => {
            get_theme(resolve);
            let e_theme = document.getElementById('theme-select');
            let opt = document.createElement('option');
            opt.value = name;
            opt.innerText = name;
            e_theme.appendChild(opt);
        }
    );
}

function on_theme_choice(select) {
    get_theme(select.value);
}

function theme_type_selected(select) {
    switch(select.value) {
        case 'bar': theme_bar(); break;
        case 'nav': theme_nav(); break;
        case 'form': theme_form(); break;
        case 'title': theme_title(); break;
        case 'article': theme_article(); break;
        case 'section': theme_section(); break;
        case 'btn': theme_btn(); break;
        case 'inp': theme_inp(); break;
        case 'gen': theme_gen(); break;
    }
}

function theme_selected(select) {
    enable_element('theme-edit-button', select.value !== 'none');
    enable_element('theme-delete-button', select.value !== 'none');
    get_theme( select.value );
}

function edit_theme() {
    server('theme/editor', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            let form = add_form('theme-editor', resolve, 20);
            form.style.left = '4vw';
            form.style.top = '10vh';
            form.style.position = 'abosolute';
        }
    );
}











