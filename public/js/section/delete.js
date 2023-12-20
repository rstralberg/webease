function delete_selected() {

    let selection = selected_section()?selected_section():selected_article();
    if (selection === false) return;

    if (selection.tagName === 'SECTION') {
        yesno('yn-delsection', 'Radera sektion', 'Är du säker?', 'delete_section_yes', 'delete_section_no');
        return;
    }

    if (selection.tagName === 'ARTICLE') {
        let container = selection.parentElement;
        if (is_valid(container)) {
            if (container.childElementCount < 2) {
                popup('Radering', 'Kan inte radera. En sida måsta ha åtmistonde en artikel');
            }
            else {
                yesno('yn-delarticle', 'Radera artkel', 'Är du säker?', 'delete_article_yes', 'delete_article_no');
            }
        }
    }
}

function delete_section_yes() {

    let section = selected_section();
    let article = section.parentElement;

    if (article.childElementCount === 1) {
        popup('Radering', 'Efterson varje artikel måste ha åtminstonde en sektion, så byts den till en tom sektion istället');
    }

    remove_form('yn-delsection');
    server('section/delete', {
        id: selected_section().id.substring(1),
        numsections: article.childElementCount,
        articleId: parseInt(article.id.substring(1))
    }).then(
        () => {
            select_section(null);
            get_content();
        }
    );
}

function delete_section_no() {
    remove_form('yn-delsection');
}

function delete_article_yes() {
    remove_form('yn-delarticle');

    let article = selected_article();
    let container = article.parentElement;
    if (is_valid(container)) {

        server('article/delete', {
            id: article.id,
            numarticles: container.childElementCount
        }).then(
            () => {
                get_content();
            }
        );
    }
}

function delete_article_no() {
    remove_form('yn-delarticle');
}
