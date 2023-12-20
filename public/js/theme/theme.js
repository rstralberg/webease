function change_theme(theme) {
    set_cookie(key() + '/theme', theme);

    get_theme(theme);

}


function get_theme(theme) {

    server('theme/get', {
        theme: theme
    }).then(
        (resolve) => {
            apply_theme(JSON.parse(resolve));
        }
    );
}


function apply_theme(theme) {
    set_style('theme',theme.theme);
    set_style('font',theme.font);
    set_style('fontsize',theme.fontsize);
    set_style('contentW',theme.contentW);
    set_style('borderRadius',theme.borderRadius);
    set_style('bg',theme.bg);
    set_style('barBg', theme.barBg);
    set_style('barBorder', theme.barBorder);
    set_style('barShadow',theme.barShadow);
    set_style('navH', theme.navH);
    set_style('navW',theme.navW);
    set_style('navMargin',theme.navMargin);
    set_style('navFg', theme.navFg);
    set_style('navActBg', theme.navActBg);
    set_style('navActFg',theme.navActFg);
    set_style('navWeight',theme.navWeight);
    set_style('footerH',theme.footerH);
    set_style('footerStyle', theme.footerStyle);
    set_style('footerWeight',theme.footerWeight);
    set_style('formBg', theme.formBg);
    set_style('formFg', theme.formFg);
    set_style('formBorder', theme.formBorder);
    set_style('formShadow',theme.formShadow);
    set_style('btnH',theme.btnH);
    set_style('btnW',theme.btnW);
    set_style('btnBg', theme.btnBg);
    set_style('btnFg', theme.btnFg);
    set_style('btnActBg', theme.btnActBg);
    set_style('btnActFg', theme.btnActFg);
    set_style('btnDisBg', theme.btnDisBg);
    set_style('btnDisFg', theme.btnDisFg);
    set_style('btnWeight', theme.btnWeight);
    set_style('btnBorder', theme.btnBorder);
    set_style('btnShadow',theme.btnShadow);
    set_style('inpH',theme.inpH);
    set_style('inpW',theme.inpW);
    set_style('inpBg', theme.inpBg);
    set_style('inpFg', theme.inpFg);
    set_style('inpActBg',theme.inpActBg);
    set_style('inpActFg', theme.inpActFg);
    set_style('inpDisBg', theme.inpDisBg);
    set_style('inpDisFg', theme.inpDisFg);
    set_style('inpWeight', theme.inpWeight);
    set_style('inpBorder', theme.inpBorder);
    set_style('inpShadow',theme.inpShadow);
    set_style('titleH',theme.titleH);
    set_style('titleW',theme.titleW);
    set_style('titleMargin',theme.titleMargin);
    set_style('titleFg',theme.titleFg);
    set_style('titleStyle',theme.titleStyle);
    set_style('titleWeight',theme.titleWeight);
    set_style('titleBorder',theme.titleBorder);
    set_style('titleShadow',theme.titleShadow);
    set_style('articleW',theme.articleW);
    set_style('articleMargin',theme.articleMargin);
    set_style('articleBg',theme.articleBg);
    set_style('articleBorder',theme.articleBorder);
    set_style('articleShadow',theme.articleShadow);
    set_style('sectionW',theme.sectionW);
    set_style('sectionMargin',theme.sectionMargin);
    set_style('sectionBg',theme.sectionBg);
    set_style('sectionFg',theme.sectionFg);
    set_style('sectionActBg',theme.sectionActBg);
    set_style('sectionBorder',theme.sectionBorder);
    set_style('sectionShadow',theme.sectionShadow);
}


