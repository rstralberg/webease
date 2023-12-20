
function theme_bar() {

    server('theme/bar', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('bar-form', resolve);
        }
    )
}

function close_theme_bar() {
    remove_form('bar-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'barBg',
            'barBorder',
            'barBorderColor',
            'barShadow'
        ],
        values: [
            get_style('barBg'),
            get_style('barBorder'),
            get_style('barBorderColor'),
            get_style('barShadow')
        ]});
}


function update_barBg(e) {
    set_style( 'barBg', e.value);
}

function update_barBorder(e) {
    set_style('barBorder', e.checked ? '1' : '0');
}

function update_barBorderColor(e) {
    set_style('barBorderColor', e.value);
}

function update_barShadow(e) {
    set_style('barShadow', e.checked ? '1' : '0');
}

