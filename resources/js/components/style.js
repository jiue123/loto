var i= 1, member = [];
while(i < 91) {
    member[i-1] = {
        "name": i
    };
    i++;
};

(function(){
    var choosed = JSON.parse(localStorage.getItem('choosed')) || {};
    var choosedCustom = JSON.parse(localStorage.getItem('choosedCustom')) || {};
    console.log(choosed);
    var speed = function(){
        return [0.1 * Math.random() + 0.01, -(0.1 * Math.random() + 0.01)];
    };
    var getKey = function(item){
        return item.name;
    };
    var createHTML = function(){
        var html = [ '<ul>' ];
        member.forEach(function(item, index){
            item.index = index;
            var key = getKey(item);
            var color = choosed[key] ? 'yellow' : 'white';
            html.push('<li><a href="#" style="color: ' + color + ';">' + item.name + '</a></li>');
        });
        html.push('</ul>');
        return html.join('');
    };
    var lottery = function(count){
        var list = canvas.getElementsByTagName('a');
        var color = 'yellow';
        var ret = member
            .filter(function(m, index){
                m.index = index;
                return !choosed[getKey(m)];
            })
            .map(function(m){
                return Object.assign({
                    score: Math.random()
                }, m);
            })
            .sort(function(a, b){
                return a.score - b.score;
            })
            .slice(0, count)
            .map(function(m){
                choosed[getKey(m)] = 1;

                switch (true) {
                    case getKey(m) < 10:
                        choosedCustom[0] = choosedCustom[0] || {};
                        Vue.set(choosedCustom[0], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 20:
                        choosedCustom[1] = choosedCustom[1] || {};
                        Vue.set(choosedCustom[1], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 30:
                        choosedCustom[2] = choosedCustom[2] || {};
                        Vue.set(choosedCustom[2], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 40:
                        choosedCustom[3] = choosedCustom[3] || {};
                        Vue.set(choosedCustom[3], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 50:
                        choosedCustom[4] = choosedCustom[4] || {};
                        Vue.set(choosedCustom[4], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 60:
                        choosedCustom[5] = choosedCustom[5] || {};
                        Vue.set(choosedCustom[5], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 70:
                        choosedCustom[6] = choosedCustom[6] || {};
                        Vue.set(choosedCustom[6], getKey(m), getKey(m));
                        break;
                    case getKey(m) < 80:
                        choosedCustom[7] = choosedCustom[7] || {};
                        Vue.set(choosedCustom[7], getKey(m), getKey(m));
                        break;
                    case getKey(m) <= 90:
                        choosedCustom[8] = choosedCustom[8] || {};
                        Vue.set(choosedCustom[8], getKey(m), getKey(m));
                        break;
                }

                list[m.index].style.color = color;
                return m.name;
            });
        localStorage.setItem('choosed', JSON.stringify(choosed));
        localStorage.setItem('choosedCustom', JSON.stringify(choosedCustom));
        return ret;
    };
    var canvas = document.createElement('canvas');
    canvas.id = 'myCanvas';
    canvas.width = document.body.offsetWidth;
    canvas.height = document.body.offsetHeight;
    document.getElementById('main').appendChild(canvas);
    new Vue({
        el: '#tools',
        data: {
            selected: 1,
            running: false,
        },
        mounted () {
            canvas.innerHTML = createHTML();
            TagCanvas.Start('myCanvas', '', {
                textColour: null,
                initial: speed(),
                dragControl: 1,
                textHeight: 14
            });
        },
        methods: {
            reset: function(){
                if(confirm('Are you want to reset?')){
                    var form = document.getElementById('resetForm'),
                        formData = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: form.getAttribute('action'),
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                    }).done(function(result) {
                        console.log(result);
                    }).fail(function(xhr, status, error) {
                        console.error(xhr, status, error);
                    }).always(function() {
                        localStorage.clear();
                        location.reload(true);
                    });
                }
            },
            onClick: function(num){
                $('#result').css('display', 'none');
                $('#main').removeClass('mask');
                this.selected = num;
            },
            toggle: function(){
                console.log(localStorage);
                if(this.running){
                    TagCanvas.SetSpeed('myCanvas', speed());
                    var ret = lottery(this.selected);
                    if (ret.length === 0) {
                        $('#result').css('display', 'block').html('<span>Has displayed all numbers!</span>');
                        return
                    }
                    $('#result').css('display', 'block').html('<span class="number">' + ret.join('</span><span>') + '</span>');
                    TagCanvas.Reload('myCanvas');
                    setTimeout(function(){
                        localStorage.setItem(new Date().toString(), JSON.stringify(ret));
                        // $('#main').addClass('mask');
                    }, 300);
                } else {
                    $('#result').css('display', 'none');
                    $('#allResult').css('display', 'none');
                    $('#main').removeClass('mask');
                    TagCanvas.SetSpeed('myCanvas', [5, 1]);
                }
                this.running = !this.running;
            },
            showResult: function() {
                if(!this.running){
                    $('#main').addClass('mask');
                    $('#result').css('display', 'none');
                    $('#allResult').css('display', 'block');

                    var html = '';
                    var obj = jQuery.parseJSON(localStorage.getItem('choosedCustom'));

                    $.each(obj, function(index, value) {
                        html += '<tr><td>';

                        $.each(value, function(i, v) {
                            html += '<span>' + v + '</span>';
                        });

                        html += '</td></tr>';
                    });

                    $('#allResult .table tbody').html(html);
                }
            }
        }
    });
})();
