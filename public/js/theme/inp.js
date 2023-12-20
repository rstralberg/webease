function theme_inp() {

    server('theme/inp', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('inp-form', resolve);
        }
    )
}

function close_theme_inp() {
    remove_form('inp-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'inpBg',
            'inpFg',
            'inpActBg',
            'inpActFg',
            'inpDisBg',
            'inpDisFg',
            'inpW',
            'inpH',
            'inpBorder',
            'inpBorderColor',
            'inpShadow'
        ],
        values: [
            get_style('inpBg'),
            get_style('inpFg'),
            get_style('inpActBg'),
            get_style('inpActFg'),
            get_style('inpDisBg'),
            get_style('inpDisFg'),
            get_style('inpW'),
            get_style('inpH'),
            get_style('inpBorder'),
            get_style('inpBorderColor'),
            get_style('inpShadow'),
        ]});
}

function update_inpBg(e) {
    set_style('inpBg', e.value);
}

function update_inpFg(e) {
    set_style('inpFg', e.value);
}

function update_inpActBg(e) {
    set_style('inpActBg', e.value);
}

function update_inpActFg(e) {
    set_style('inpActFg', e.value);
}

function update_inpDisBg(e) {
    set_style('inpDisBg', e.value);
}

function update_inpDisFg(e) {
    set_style('inpDisFg', e.value);
}

function update_inpW(e) {
    set_style('inpW', e.value + 'em');
}

function update_inpH(e) {
    set_style('inpH', e.value + 'em');
}

function update_inpBorder(e) {
    set_style('inpBorder', e.checked ? '1' : '0');
}

function update_inpBorderColor(e) {
    set_style('inpBorderColor', e.value);
}

function update_inpShadow(e) {
    set_style('inpShadow', e.checked ? '1' : '0');
}


