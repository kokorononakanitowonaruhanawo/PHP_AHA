$(function() {

    //変数定義--------------------
    var time = 5;
    var timeID;
    var per = 0;


    //関数定義--------------------

    // 残りの秒数を表示
    function displayText() {
        $('#countDown').text(time);
    };

    //秒数を減らす
    function countDown() {
        if (time <= 0) {
            clearInterval(timeID);
        }
        time--;
    };

    //カウントダウン スタート
    function startCountDown(after) {
        clearInterval(timeID);    //重複を防ぐために今動いているタイマーをクリア
        timeID = setInterval(function(){
            if(time <= 0){
                clearInterval(timeID);
                after();
            } else {
                countDown();
                displayText();
            }
        }, 1000);
    };


    // 問題はじめる準備
    function openingAHA(after) {
        $.when(
            $('#btnStart').hide(),
            $('#countDown').hide(100),
            $('.before').css('transition',''),
            // $('.before').css('visibility','visible'),
            $('.before').addClass('active'),
            $('.after').removeClass('active'),
            $('.before').css('opacity', 1),
            $('.progress').css('visibility','visible'),
            // $('.progress').css('display', 'block'),
            // $('.after').css('opacity', 1)
        ).done(function(){
            $('#progressBar').show();
            after()
        }).fail(function() {

        });
    };

    // progress bar のパーセントを増やす
    function increasePer() {
        if (per >= 100) {
            clearInterval(timeID);
        }
        per++;
    };
    
    function controlPer(after) {
        clearInterval(timeID);    //重複を防ぐために今動いているタイマーをクリア
        timeID = setInterval(function(){
            if(per >= 100){
                clearInterval(timeID);
                after();
            } else {
                increasePer();
                displayProgressValue();
            }
        }, 100);
    }

    //問題開始
    function startAHA() {
        $('.after').addClass('active');
        $('.after').css('visibility', 'visible');
        $('.before').css('opacity', 0);
        // $('.before').animate({opacity: 0}, 3000);
    };

    //progress bar の数字を表示
    function displayProgressValue() {
        $('.progress-bar').css('width', per + '%');
        $('.progress-bar').prop('aria-valuenow', per);
        $('.progress-bar').text(per + '%');
    }


    // 終了やリトライを表示
    function　displayRetry() {
        $('#btnStart').show(100);
        $('#btnStart').text('retry');
        $('#countDown').show(100);
        $('#countDown').text('終');
        $('.after').removeClass('active');
        $('.before').removeClass('active');
        // $('.before').css('opacity', 1);
        $('.progress').css('visibility','hidden');
        time = 5;
        per = 0;
        displayProgressValue();
    }

    //答えを表示
    function displayAnswer() {
        $('#btnStart').prop('disable', true);
        $('#btnStart').show(100);
        $('#btnStart').text('answer');
        $('#countDown').hide(100);
        $('.progress').css('visibility','hidden');
        $('.after').removeClass('active');
        $('.before').removeClass('active');
        $('.answer').addClass('active');
    }

    //実行処理-------------------
    displayText();
    $('#progressBar').hide();
    var playCount = 0;
    $('#btnStart').click(function() {
        playCount++;
        if (playCount<=2) {
            displayText();
            startCountDown(function() {
                openingAHA(function() {
                    startAHA();
                    controlPer(function() {
                        // if (playCount===1) {
                            displayRetry();
                            $('#btnStart').hide();
                        // } else if (playCount===2) {
                        //     displayAnswer();
                        // }
                    });
                });
            });
        // } else {
        //     $('#btnStart').hide();
        };
    });



    $('#retry').click(function()
    {
        location.reload();
    });
    
    

});

