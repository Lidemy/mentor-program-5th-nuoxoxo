document.querySelector('.section__faq').addEventListener('click', (e) => {
    if (e.target.closest('.section__faq-block')) {
        e.target.closest('.section__faq-block').classList.toggle('hide-p')
    }
})