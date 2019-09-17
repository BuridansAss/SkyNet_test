window.onload = function() {
    console.log('window loaded');

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