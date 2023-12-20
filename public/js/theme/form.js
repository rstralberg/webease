function theme_form() {

    server('theme/form', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('form-form', resolve);
        }
    )
}

function close_theme_form() {
    remove_form('form-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'formBg',
            'formFg',
            'formBorder',
            'formBorderColor',
            'formShadow'
        ],
        values: [
            get_style('formBg'),
            get_style('formFg'),
            get_style('formBorder'),
            get_style('formBorderColor'),
            get_style('formShadow')
        ]});
}

function update_formBg(e) {
    set_style('formBg', e.value);
}

function update_formFg(e) {
    set_style('formFg', e.value);
}

function update_formBorder(e) {
    set_style('formBorder', e.checked ? '1' : '0');
}

function update_formBorderColor(e) {
    set_style('formBorderColor', e.value );
}

function update_formShadow(e) {
    set_style('formShadow', e.checked ? '1' : '0');
}


