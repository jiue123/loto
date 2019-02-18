var inputArr = [];

var createArr = function (max) {
    var i = 1 ;
    while(i<max) {
        inputArr[i] = i;
        i++;
    }
};

createArr(20);

$(document).on('click', '.buttonGroup button', (e) => {
    const $target = $(e.target);

    var randomItem = inputArr[Math.floor(Math.random() * inputArr.length)];

    $('.circle p').text(randomItem);
});
