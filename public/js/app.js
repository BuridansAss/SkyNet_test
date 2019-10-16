window.onload = function() {
    console.log('window loaded');

    let variants = document.getElementsByClassName('getVariant');
    let choices = document.getElementsByClassName('choice');
    let buyButton = document.getElementById('buy-button');


    for (let variant of variants) {
        variant.onclick = async function () {
            let id = variant.getAttribute('id');
            let pref = variant.getAttribute('pref');

            const response = await fetch(pref + '?main/getVariants/tariffId=' + id, {
                method: 'GET'
            });

            const body = await response.text();

            let doc = document.open("text/html", "replace");
            doc.write(body);
            doc.close();
        };
    }

    for (let choice of choices) {
        choice.onclick = async function () {
            let id = choice.getAttribute('id');
            let tariffId = choice.getAttribute('tariff');
            let pref = choice.getAttribute('pref');

            const response = await fetch(pref + '?main/choice/tariffId=' + tariffId + '&variantId=' + id, {
                method: 'GET'
            });

            const body = await response.text();

            let doc = document.open("text/html", "replace");
            doc.write(body);
            doc.close();
        };
    }

    if (buyButton !== null) {
        buyButton.onclick = function () {
            alert('Поздравляю с покупкой, Абонент =)')
        }
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