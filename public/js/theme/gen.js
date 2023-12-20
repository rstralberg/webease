function theme_gen() {

    server('theme/gen', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('gen-form', resolve);
        }
    )
}

function close_theme_gen() {
    remove_form('gen-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'font',
            'fontsize',
            'bg',
            'contentW',
            'footerH',
            'borderRadius',
            'sectionTitleFg',
            'sectionTitleBorder',
            'sectionTitleBorderColor',
            'sectionTitleShadow',
            'weblinkFg'
        ],
        values: [
            get_style('font'),
            get_style('fontsize'),
            get_style('bg'),
            get_style('contentW'),
            get_style('footerH'),
            get_style('borderRadius'),
            get_style('sectionTitleFg'),
            get_style('sectionTitleBorder'),
            get_style('sectionTitleBorderColor'),
            get_style('sectionTitleShadow'),
            get_style('weblinkFg')
        ]});
}

function update_theme_font(e) {
    set_style('font', e.value);
}

function update_theme_fontsize(e) {
    set_style('fontsize', e.value + 'em');
}

function update_bg(e) {
    set_style('bg', e.value);
}

function update_contentW(e) {
    set_style('contentW', e.value + 'vw');
}

function update_footerH(e) {
    set_style('footerH', e.value + 'vh');
}

function update_borderRadius(e) {
    set_style('borderRadius', e.value + 'px');
}

function update_sectionTitleFg(e) {
    set_style('sectionTitleFg', e.value);
}

function update_sectionTitleBorder(e) {
    set_style('sectionTitleBorder', e.checked ? '1' : '0');
}

function update_sectionTitleBorderColor(e) {
    set_style('sectionTitleBorderColor', e.value);
}

function update_sectionTitleShadow(e) {
    set_style('sectionTitleShadow', e.checked ? '1' : '0');
}

function update_weblinkFg(e) {
    set_style('weblinkFg', e.value);
}

