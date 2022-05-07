window.addEventListener('load', function(){
    const $btn = document.getElementById("slideMenuBtn");
    const $nav = document.getElementById("slideMenuNav");
    $btn.addEventListener('click',(e) => {
        $nav.classList.toggle('open-menu')
    });
});

