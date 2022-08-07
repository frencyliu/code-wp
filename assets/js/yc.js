(function () {
    //logo
    let count = 0;
    setInterval(() => {
        const logoDots = document.querySelectorAll(".logo-dot");
        logoDots.forEach((dot) => {
            const a = parseInt(Math.random() * 256),
                b = parseInt(Math.random() * 256),
                c = parseInt(Math.random() * 256),
                opacity_value = count % 2;
            dot.style.opacity = opacity_value;
            dot.style.backgroundColor = "rgb(" + a + "," + b + "," + c + ")";
        });

        count++;
        //console.log(Math.random() * 256, '0~255亂數' )
    }, 1000);


})();
