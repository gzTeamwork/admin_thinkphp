// ;(function () {
setTimeout(function () {


    //  body主体样式
    document.body.style.height = "100vh";
    document.body.style.background = "url('assets/imgs/bg.png') no-repeat";
    document.body.style.backgroundSize = "100% 100%";
    document.body.style.overflow = 'hidden';
    //  底部花纹
    bottom_flower.style.background = "url('assets/imgs/bottom_flower.png') no-repeat";
    bottom_flower.style.backgroundSize = "cover";
    bottom_flower.style.bottom = 0
    bottom_flower.style.left = 0;
    bottom_flower.style.width = "100vw";
    bottom_flower.style.height = '23.6vh';
    bottom_flower.style.position = 'fixed';
    //  顶部logo
    company_logo.style.background = "url('assets/imgs/logo.png') no-repeat top";
    company_logo.style.backgroundSize = 'contain';
    company_logo.style.position = 'fixed';
    company_logo.style.top = 0;
    company_logo.style.left = '2vw'
    company_logo.style.width = '30vw'
    company_logo.style.height = '10vh'

    var player = document.getElementById('mp3play');


    player.play();
}, 10)
// })()