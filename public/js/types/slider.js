
function add_slider() {
    server('types/sliderform', {}).then(
        (resolve) => {
            add_form('slider-form', resolve, parseInt(get_style('contentW')));
        }
    );

}

function slider_image_selected(element) {

    const imageInput = element;
    if (imageInput.files.length > 0) {
        const selectedImage = imageInput.files[0];
        let folder = pageid();
        upload_image(selectedImage, folder).then(
            (resolve) => {
                if (resolve.ok) {
                    let img = document.createElement('img');
                    add_class(img, 'slider-img');
                    add_class(img, 'shadow');
                    img.addEventListener('load', (e) => {

                        let slides = document.createElement('div');
                        add_class(slides, 'slides');
                        add_class(slides, 'slider-fade');
                        slides.appendChild(e.target);

                        let container = document.getElementById('sf-slider');
                        container.appendChild(slides);

                        slides.style.display = 'block';
                    });
                    img.src = image_page_path(resolve.content);
                }
            }
        );
    }
    showSlides();
}

function slider_time(element) {
    slideTime = element.value;
}

function slider_shadow_toggle(element) {
    let shadow = element.checked;
    let slides = document.getElementsByClassName('slides');
    if (is_valid(slides) && slides.length > 0) {
        for (let i = 0; i < slides.length; i++) {
            let img = slides[i].querySelector('img');
            if (is_valid(img)) {
                if (shadow && !img.classList.contains('shadow')) {
                    add_class(img, 'shadow');
                }
                else if (!shadow && img.classList.contains('shadow')) {
                    remove_class(img, 'shadow');
                }
            }
        }

    }

}

function close_slider() {
    remove_form('slider-form');
}

function save_slider() {

    let article = selected_article();

    let container = document.getElementById('sf-slider');
    let imgs = container.querySelectorAll('img');
    let images = new Array();
    for (let i = 0; i < imgs.length; i++) {
        images.push(filename_only(imgs[i].src));
    }

    server('add/section', {
        articleId: article.id,
        pos: article.childElementCount,
        type: 'slider',
        align: 'center',
        content: JSON.stringify({
            images: images,
            shadow: document.getElementById('sf-shadow').checked,
            speed: document.getElementById('sf-speed').value
        })
    }).then(
        () => {
            get_content();
        }
    );

    remove_form('slider-form');
}

let slideTime = 5;
let slideIndex = 0;

function startSlides() {
    let slideTime = 5;
    let slideIndex = 0;
    showSlides()
}

function showSlides() {

    let slides = document.getElementsByClassName('slides');
    if (!is_valid(slides) || slides.length === 0) {
        setTimeout(showSlides, slideTime * 1000);
        return;
    }

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }

    if (is_valid(slides[slideIndex - 1])) {
        slides[slideIndex - 1].style.display = "block";
    }
    setTimeout(showSlides, slideTime * 1000);
}


function enable_sliders(container) {

    let articles = container.querySelectorAll('article');
    articles.forEach(article => {
        let sections = article.querySelectorAll('section');
        for( let i=0; i < sections.length; i++ ) {
            let section = sections[i];
            if( section.getAttribute('type') === 'slider') {
                let slides = section.getElementsByClassName('slides');
                if( slides.length > 0 ) {
                    slides[0].style.display = 'block';
                }
                
            }
        };
    });
}

function slide_next(timeout,slides) {
 
    if (!is_valid(slides) || slides.length === 0) {
        setTimeout(showSlides, timeout * 1000);
        return;
    }

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }

    if (is_valid(slides[slideIndex - 1])) {
        slides[slideIndex - 1].style.display = "block";
    }
    setTimeout(slide_next, slideTime * 1000, slides);   
}