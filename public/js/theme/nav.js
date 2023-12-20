function theme_nav() {

    server('theme/nav', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('nav-form', resolve);
        }
    )
}

function close_theme_nav() {
    remove_form('nav-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'navW',
            'navH',
            'navMargin',
            'navFg',
            'navActBg',
            'navActFg',
            'navWeight',
        ],
        values: [
            get_style('navW'),
            get_style('navH'),
            get_style('navMargin'),
            get_style('navFg'),
            get_style('navActBg'),
            get_style('navActFg'),
            get_style('navWeight')
        ]});
}

function update_navFg(e) {
    set_style('navFg', e.value);
}

function update_navActBg(e) {
    set_style('navActBg', e.value);
}

function update_navActFg(e) {
    set_style('navActFg', e.value);
}

function update_navW(e) {
    set_style('navW', e.value + 'vw');
}

function update_navH(e) {
    set_style('navH', e.value + 'vh');
}

function update_navMargin(e) {
    set_style('navMargin', e.value + 'vh');
}

function update_navWeight(e) {
    set_style('navWeight', e.checked ? 'bold' : 'normal');
}
