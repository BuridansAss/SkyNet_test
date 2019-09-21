window.onload = function() {
    console.log('window loaded');

    let variants = document.getElementsByClassName('getVariant');


    for (let variant of variants) {
        variant.onclick = function () {
            let id = variant.getAttribute('id');
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'main/getVariants/tariffId=' + id, false);
            xhr.send();
        };
    }

    let getWindowWidth = function() {
        return  window.innerWidth;
    };

    let getWindowHeight = function() {
        return window.innerHeight;
    };

    window.onresize = function() {
        let width = getWindowWidth();
        let height = getWindowHeight();

        console.log(width + ' ' + height);

        if (width < 640) {

        } else if (width < 1024) {

        } else {

        }
  }

};