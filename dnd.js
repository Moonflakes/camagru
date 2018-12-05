window.onload=function(){
    var flag = false,
        block = document.querySelector('.wrap'),
        cont = document.querySelector('.cont');

    document.addEventListener('mousemove', function(e){
        e = e || window.event;
        if (!flag)
            return;
        var x = e.clientX,
            y = e.clientY;
        block.style.left = x - block.clientWidth / 2 + 'px';
        block.style.top = y - block.clientHeight / 2 + 'px';
        block.style.cursor = 'move';
    });
    block.addEventListener('mousedown', function(e){
        flag = true;
    });
    document.addEventListener('mouseup', function(e){
        flag = false;
        block.style.cursor = 'default';
        var x = e.clientX,
            y = e.clientY,
            contL = cont.offsetLeft,
            contT = cont.offsetTop,
            contW = cont.clientWidth,
            contH = cont.clientHeight,
            contR = contL + contW,
            contB = contT + contH;
        console.log(contL, contT, contW, contH, contR, contB);
        if (x >= contL && x <= contR && y >= contT && y <= contB){
            block.style.left = x - block.clientWidth / 2 + 'px';
            block.style.top = y - block.clientHeight / 2 + 'px';
        }
        else{
            block.style.left = '50%';
            block.style.top = '50%';
        }
    });
}