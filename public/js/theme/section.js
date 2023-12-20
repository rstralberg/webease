function theme_section() {

    server('theme/section', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('section-form', resolve);
        }
    )
}

function close_theme_section() {
    remove_form('section-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'sectionW',
            'sectionMargin',
            'sectionBg',
            'sectionFg',
            'sectionActBg',
            'sectionBorder',
            'sectionBorderColor',
            'sectionShadow'
        ],
        values: [
            get_style('sectionW'),
            get_style('sectionMargin'),
            get_style('sectionBg'),
            get_style('sectionFg'),
            get_style('sectionActBg'),
            get_style('sectionBorder'),
            get_style('sectionBorderColor'),
            get_style('sectionShadow')
        ]
    });
}

function update_sectionW(element) {
    set_style('sectionW', element.value + '%');
}

function update_sectionMargin(element) {
    set_style('sectionMargin', element.value + 'vh');
}

function update_sectionBg(element) {
    set_style('sectionBg', element.value);
}

function update_sectionFg(element) {
    set_style('sectionFg', element.value);
}

function update_sectionActBg(element) {
    set_style('sectionActBg', element.value);
}

function update_sectionBorder(element) {
    set_style('sectionBorder', element.checked ? '1' : '0');
}

function update_sectionBorderColor(element) {
    set_style('sectionBorderColor', element.value);
}

function update_sectionShadow(element) {
    set_style('sectionShadow', element.checked ? '1' : '0');
}

