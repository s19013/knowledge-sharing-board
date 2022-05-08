window.addEventListener('load', function(){
    const $btn = document.getElementById("LeftSlideMenuBtn");
    const $nav = document.getElementById("LeftSlideMenuNav");
    $btn.addEventListener('click',(e) => {
        $nav.classList.toggle('open-menu')
    });
});

window.addEventListener('load', function(){
    const $btn = document.getElementById("RightSlideMenuBtn");
    const $nav = document.getElementById("RightSlideMenuNav");
    $btn.addEventListener('click',(e) => {
        $nav.classList.toggle('open-menu')
    });
});

