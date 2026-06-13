document.addEventListener('DOMContentLoaded', () => {

    const sliders = document.querySelectorAll('.team-slider');

    sliders.forEach(slider => {

        slider.addEventListener('wheel', (e) => {

            e.preventDefault();

            slider.scrollLeft += e.deltaY ;

        });

        let autoScroll = null;

        slider.addEventListener('mouseenter', () => {

            autoScroll = setInterval(() => {

                slider.scrollLeft += 1;

            }, 20);

        });

        slider.addEventListener('mouseleave', () => {

            clearInterval(autoScroll);

        });

    });

});