let myCarousel = document.querySelectorAll('#eventslider .carousel .carousel-item');
myCarousel.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = myCarousel[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});

let myCarousel1 = document.querySelectorAll('#productslider .carousel .carousel-item');
myCarousel1.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = myCarousel1[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});

let myCarousel2 = document.querySelectorAll('#newsslider .carousel .carousel-item');
myCarousel2.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = myCarousel2[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});

let myCarousel3 = document.querySelectorAll('#videoslider .carousel .carousel-item');
myCarousel3.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = myCarousel3[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});

let myCarousel4 = document.querySelectorAll('#courseslider .carousel .carousel-item');
myCarousel4.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = myCarousel4[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});
