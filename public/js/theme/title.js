function theme_title() {

    server('theme/title', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('title-form', resolve);
        }
    )
}

function close_theme_title() {
    remove_form('title-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'titleH',
            'titleW',
            'titleMargin',
            'titleFg', 
            'titleStyle',
            'titleWeight', 
            'titleBorder',
            'titleBorderColor',
            'titleShadow',
               ],
        values: [
            get_style('titleH'),
            get_style('titleW'),
            get_style('titleMargin'),
            get_style('titleFg'),
            get_style('titleStyle'),
            get_style('titleWeight'), 
            get_style('titleBorder'),
            get_style('titleBorderColor'),
            get_style('titleShadow')
                ]
    });
}

function update_tltleW(element) {
    set_style('titleW', element.value +  '%');
}

function update_tltleH(element) {
    set_style('titleH', element.value + 'vh');
}

function update_tltleMargin(element) {
    set_style('titleMargin', element.value + 'vh');
}

function update_tltleFg(element) {
    set_style('titleFg', element.value);
}

function update_tltleStyle(element) {
    set_style('titleStyle', element.checked ? 'italic' : 'normal');
}

function update_tltleWeight(element) {
    set_style('titleWeight', element.checked ? 'bold' : 'normal');
}

function update_tltleBorder(element) {
    set_style('titleBorder', element.checked ? '1' : '0');
}

function update_tltleBorderColor(element) {
    set_style('titleBorderColor', element.value);
}

function update_tltleShadow(element) {
    set_style('titleShadow', element.checked ? '1' : '0');
}

