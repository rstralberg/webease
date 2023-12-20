function theme_btn() {

    server('theme/btn', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('btn-form', resolve);
        }
    )
}

function on_close_theme_btn() {
    remove_form('btn-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'btnBg',
            'btnFg',
            'btnActBg',
            'btnActFg',
            'btnDisBg',
            'btnDisFg',
            'btnW',
            'btnH',
            'btnBorder',
            'btnBorderColor',
            'btnShadow'
        ],
        values: [
            get_style('btnBg'),
            get_style('btnFg'),
            get_style('btnActBg'),
            get_style('btnActFg'),
            get_style('btnDisBg'),
            get_style('btnDisFg'),
            get_style('btnW'),
            get_style('btnH'),
            get_style('btnBorder'),
            get_style('btnBorderColor'),
            get_style('btnShadow'),
        ]});
}

function update_btnBg(e) {
    set_style('btnBg', e.value);
}

function update_btnFg(e) {
    set_style('btnFg', e.value);
}

function update_btnActBg(e) {
    set_style('btnActBg', e.value);
}

function update_btnActFg(e) {
    set_style('btnActFg', e.value);
}

function update_btnDisBg(e) {
    set_style('btnDisBg', e.value);
}

function update_btnDisFg(e) {
    set_style('btnDisFg', e.value);
}

function update_btnW(e) {
    set_style('btnW', e.value + 'em');
}

function update_btnH(e) {
    set_style('btnH', e.value + 'em');
}

function update_btnBorder(e) {
    set_style('btnBorder', e.checked ? '1' : '0');
}

function update_btnBorderColor(e) {
    set_style('btnBorderColor', e.value );
}

function update_btnShadow(e) {
    set_style('btnShadow', e.checked ? '1' : '0');
}


