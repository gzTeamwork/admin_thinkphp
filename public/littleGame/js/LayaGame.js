//  声明全局变量
var WebGL = Laya.WebGL;
var Loader = Laya.loader;
var Stat = Laya.Stat;
var Sprite = Laya.Sprite;
var Stage = Laya.Stage;
var Browser = Laya.Browser;
var Tween = Laya.Tween;
var Event = Laya.Event;
var Rectangle = Laya.Rectangle;
var Texture = Laya.Texture;
var Handler = Laya.Handler;
var UIGroup = Laya.UIGroup;

// var Rate;   //  屏幕缩放比例
var PositonX; //    左移修正
var LayerIndex = { ui: 0, game: 1, main: 2, chip: 3 };
var GameWords = ['GOOD!', 'GREATE!', 'PERFECT!', 'WONDERFUL!', 'WOW~', 'NICE!', 'AMAZING!!!']

var touchTimes, randomLimitTIme;
touchTimes = 0;
randomLimitTIme = 3;
var PuddingTemplate = new Laya.Templet();
var mAniPath = 'res/dragonBones/pudding/pudding.sk';    //粽子皮

//  视图实例化
var UIstart, UIopening, UIgameing, UIwin, UIlost;
var GlobalBgUI;
var GameMain = (function () {
    /**
     * @todo 声明游戏对象
     */
    ; (function () {
        //  抗锯齿
        Laya.Config.isAntialias = true;
        Config.isAlpha = true;
        //  初始化
        // alert(Laya.Browser.pixelRatio);
        // Laya.init(window.innerWidth * ((Browser.width / window.innerWidth) - 1), window.innerHeight * ((Browser.height / window.innerHeight) - 1), WebGL);
        // alert(window.innerWidth * ((Browser.width / window.innerWidth) - 1) + ',' + window.innerHeight * ((Browser.height / window.innerHeight) - 1));
        Laya.init(Browser.width, Browser.height, WebGL);
        // alert(Browser.width + ',' + Browser.height);
        // Stat.show(0, 0);
        //  开启鼠标事件
        Laya.stage.mouseEnabled = true;
        Laya.stage.scaleMode = Laya.Stage.SCALE_SHOWALL;
        console.log(Laya.stage.scaleMode);
        // Laya.stage.bgColor = "#213823";
        Laya.stage.bgColor = "none";
        Laya.stage.alignV = Stage.ALIGN_MIDDLE;
        Laya.stage.alignH = Stage.ALIGN_CENTER;

        var resArray = [
            { url: 'res/atlas/comp.atlas', type: Laya.Loader.ATLAS }
        ]
        Laya.loader.load(resArray, Laya.Handler.create(this, stageSetup));
    })();
    function stageSetup() {
        console.log('舞台加载完毕..')
        // Laya.SoundManager.playMusic('assets/mp3/bgm.mp3', 0);
        // Laya.SoundManager.playMusic('https://layaair.ldc.layabox.com/demo/h5/res/sounds/bgm.mp3', 0);
        // Laya.stage.addChildAt(GlobalBgUI, 0);
        var game = new GameLogics();
        game.stageOpen();
    }
})();

var GameLogics = function () {
    // Rate = window.innerHeight / 1572
    // Rate = Browser.pixelRatio > 2 ? Rate * 2 : Rate;
    // //  UI左移坐标修正
    // PositonX = Browser.pixelRatio > 2 ? 720 * Rate / 3 : 720 * Rate;
    UIstart = new startUI();
    UIopening = new openViewUI();
    UIgameing = new gamingUI();
    UIwin = new winUI();
    UIlost = new lostUI();

    var UIlostPudding = true;
    var UIwinPudding = true;
    /**
     * 资源加载
     */
    ; (function () {
        UIstart.x = (Laya.stage.width - UIstart.width) / 2;
        UIopening.x = (Laya.stage.width - UIopening.width) / 2;
        UIgameing.x = (Laya.stage.width - UIgameing.width) / 2;
        UIwin.x = (Laya.stage.width - UIwin.width) / 2;
        UIlost.x = (Laya.stage.width - UIlost.width) / 2;
        Laya.stage.addChildAt(UIstart, LayerIndex.ui);

    })()



    //  绑定游戏开始事件
    // var gameBeginBtn = UIopening.getChildByName('gameBeginBtn');
    // gameBeginBtn.on(Event.MOUSE_DOWN, this, beginBtnHandler);
    //  绑定游戏重开事件
    var restartBtn = UIlost.getChildByName('restartBtn');
    restartBtn.on(Event.MOUSE_DOWN, this, beginBtnHandler);
    //  绑定游戏准备按钮
    var readyBtn = UIstart.getChildByName('gameStarted');
    readyBtn.on(Laya.Event.MOUSE_DOWN, this, function () {
        UIstart.removeSelf();
        Laya.stage.addChild(UIopening);
        this.stageReady();
    })

    /**
     * @todo 重置ui
     * 点击开始游戏按钮
     */
    function beginBtnHandler() {
        console.log('开始游戏...')

        UIlost.removeSelf();
        var p = UIlost.getChildByName("pudding");

        p != null ? UIlost.getChildByName('pudding').removeSelf() : '';

        UIgameing.removeSelf();
        UIgameing.destroy();
        UIgameing = new gamingUI();
        UIgameing.x = (Laya.stage.width - UIgameing.width) / 2;
        UIopening.removeSelf();

        this.stageGame();
    }

    //  获取粽子模型对象
    function LoadPudding(UI, skinIndex = 0, xPer = 1, yPer = 1) {
        console.log('加载粽子~')
        console.log(UI)
        PuddingModel = PuddingTemplate.buildArmature(1);
        PuddingModel.name = "pudding";
        UI.addChildAt(PuddingModel, 3);
        PuddingModel.pos(UI.width * xPer, UI.height * yPer);
        PuddingModel.scale(.9, .9)
        PuddingModel.play(skinIndex, true);
    }

    /**
     * 游戏开场场景初始化...
     */
    this.stageOpen = function () {
        console.log('游戏开场场景初始化...');
        PuddingTemplate = new Laya.Templet();
        PuddingTemplate.on(Event.COMPLETE, this, LoadPudding, [UIstart, 0, .5, .52]);
        PuddingTemplate.loadAni(mAniPath);
        UIopening.once(Laya.Event.DISPLAY, this, function () {
            UIopening._aniList[0].play(1, false);
            Laya.timer.once(2800, this, beginBtnHandler);
        })
    }

    this.stageReady = function () {
        console.log('游戏准备场景初始化...')
        PuddingTemplate = new Laya.Templet();
        PuddingTemplate.on(Event.COMPLETE, this, LoadPudding, [UIopening, 0, .5, .52]);
        PuddingTemplate.loadAni(mAniPath);
    }

    /**
     * 游戏中场景初始化...
     */
    this.stageGame = function () {
        console.log('游戏中场景初始化...')

        //  声明游戏对象
        //  游戏机制变量:剥粽子数量,游戏计时,游戏计时计数器,游戏最大计时,游戏状态,游戏滑动计数器
        var GameTotal, GameTimeCounter, GameTime, GameTimeMax, GameStatus, GameSwipeCounter, GameMaxTime, GameWinCondition;
        //  触摸/点击事件:是否被点击,是否划动,是否执行1次,是否碰撞,被触摸点坐标
        var isTouch, isSwipe, isOnce, isHit, TouchPoint;
        //  粽子变量:粽子动画模板,粽子,粽子掉皮,粽子表情列表
        var PuddingTemp, Pudding, PuddingSkinChip, PuddingFaceList, PuddingFa;
        //  划动痕迹:划痕堆栈,单个划痕
        var SwipeLines, SwipeLine;

        PuddingTemplate = new Laya.Templet();
        PuddingTemplate.on(Event.COMPLETE, this, function () {
            Pudding = PuddingTemplate.buildArmature(1);
            UIgameing.addChildAt(Pudding, 3);
            // console.log(UI.height)
            Pudding.pos(UIgameing.width / 2, UIgameing.height / 2);
            Pudding.scale(.9, .9)
            Pudding.play(1, true);
        })
        PuddingTemplate.loadAni(mAniPath);
        //  载入游戏界面 - UIgameing
        Laya.stage.addChildAt(UIgameing, LayerIndex.ui);

        var PuddingData = new function () {
            this.faceList = ['smile', 'poor', 'normal', 'chagrin', 'unwilling'];
            this.faceIndex = 0;
            this.maxHp = 7;
            this.Hp = 0;
        }

        //  初始化变量值
        GameTotal = GameSwipeCounter = GameTimeCounter = 0;
        isTouch = isSwipe = isHit = false;
        isOnce = true;
        SwipeLines = [];
        PuddingData.Hp = PuddingData.maxHp;
        GameMaxTime = 15;
        GameWinCondition = 8;
        PuddingSkinChip = new Laya.Image();
        this.spriteAlign(PuddingSkinChip);

        GameStatus = true;

        //  开启计时器
        var timeLolly = UIgameing.getChildByName('time_counter_lolly');
        var timeTop = UIgameing.getChildByName('time_counter_top');
        var timeWidth = timeTop.x + timeTop.width - timeLolly.x;
        var totalTop = UIgameing.getChildByName('total_counter');
        var totalLolly = totalTop.getChildByName('total_counter_lolly');
        var totalWidth = totalTop.x + totalTop.width - timeLolly.x;
        var timeNumber = UIgameing.getChildByName('time_number');
        Laya.timer.loop(1000, this, timerEachSecound)

        //  计时器每秒事件
        function timerEachSecound() {
            console.log('每秒轮询事件触发')
            if (!GameStatus) {
                Laya.timer.clear(this, timerEachSecound);
                Laya.timer.once(0, this, gameOver);
                return false;
            }
            ++GameTimeCounter;
            timeNumber.text = GameTimeCounter;
            if (GameTimeCounter + 1 > GameMaxTime) {
                // Laya.timer.clear();
                UIgameing.off(Event.MOUSE_DOWN, this, eventMouseDown);
                UIgameing.off(Event.MOUSE_MOVE, this, eventMouseMove);
                UIgameing.off(Event.MOUSE_UP, this, eventMouseUp);
                GameStatus = false;
            }
            // console.log(timeLolly);
            //  时间计时条缓动动画
            Tween.to(timeLolly, { width: timeWidth * 0.7 / GameMaxTime * GameTimeCounter }, 500)
            //  划痕回收
            // console.log(GarbageRes);
            // if (GarbageRes.length > 0 && GarbageRes != null) {
            //     GarbageRes.map(function (e, i) {
            //         GarbageRes.pop(i);
            //         e.destroy();
            //     });
            //     console.log('回收资源')
            // }
        }
        /**
         * @todo 游戏结束
         */
        function gameOver() {
            console.log('游戏结束...');
            UIgameing.removeSelf();
            Laya.stage.off(Event.MOUSE_MOVE, this, eventMouseMove);
            Laya.stage.off(Event.MOUSE_UP, this, eventMouseUp);
            Laya.stage.off(Event.MOUSE_DOWN, this, eventMouseDown);
            if (GameTotal < GameWinCondition) {
                //  输了
                Laya.stage.addChild(UIlost);

                PuddingTemplate = new Laya.Templet();
                PuddingTemplate.on(Event.COMPLETE, this, LoadPudding, [UIlost, 2, .5, .52]);
                PuddingTemplate.loadAni(mAniPath);

                var lostCounter = UIlost.getChildByName('lost_counter');
                lostCounter.text = '' + GameTotal + '';
            } else {
                //  赢了
                Laya.stage.addChild(UIwin);

                PuddingTemplate = new Laya.Templet();
                PuddingTemplate.on(Event.COMPLETE, this, LoadPudding, [UIwin
                    , 3, .5, .52]);
                PuddingTemplate.loadAni(mAniPath);
                var winCounter = UIwin.getChildByName('box').getChildByName('win_counter');
                winCounter.text = '' + GameTotal + '';
                console.log(UIwin);
                // var winFlower = UIwin.getChildByName('win_flower');
                // winFlower.pos(UIwin.width / 2, UIwin.height / 2)
                // winFlower.width = UIwin.width;

            }
        }

        //  绑定舞台事件
        Laya.stage.on(Event.MOUSE_DOWN, this, eventMouseDown);
        // Laya.stage.on(Event.MOUSE_MOVE, this, eventMouseMove);
        Laya.stage.on(Event.MOUSE_UP, this, eventMouseUp);

        //  鼠标按下
        function eventMouseDown(event) {
            // console.log('触点按下');
            var touchTarget = event.target;
            isTouch = true;
            TouchPoint = { x: touchTarget.mouseX, y: touchTarget.mouseY };
            SwipeLine = new Laya.Sprite();
            PuddingSkinChip = new Laya.Sprite();
            PuddingSkinChip.loadImage('assets/imgs/pudding/skin_part_' + (PuddingData.maxHp - PuddingData.Hp + 1) + '.png');
            // PuddingSkinChip.scale(0.5, 0.5);
            this.spriteAlign(PuddingSkinChip);
            Laya.stage.on(Event.MOUSE_MOVE, this, eventMouseMove);
            //  随机脸
            PuddingData.faceIndex = 1 + Math.ceil(Math.random() * 3);
        }

        //  鼠标移动
        function eventMouseMove(event) {
            // console.log('触点移动')
            var touchTarget = event.target;
            if (!this.spriteCollision(UIgameing, { x: touchTarget.mouseX, y: touchTarget.mouseY })) {
                console.log('0');
            }
            if (isTouch) {
                isSwipe = true;
                //  粽子碰撞检测并执行1次
                if (this.spriteCollision(Pudding, { x: touchTarget.mouseX, y: touchTarget.mouseY })) {
                    isHit = true;
                    if (isOnce) {
                        //  被划到要变脸
                        Pudding.replaceSlotSkinName('face', 'face/face_1', 'face/face_' + PuddingData.faceIndex)
                        //  被划到需要丢皮 - 丢皮移到松开事件 -> eventMouseUp
                        this.spriteAlign(PuddingSkinChip);
                        Laya.stage.addChild(PuddingSkinChip);
                    }
                    // })
                    isOnce = false;
                    PuddingSkinChip.pos(touchTarget.mouseX
                        , touchTarget.mouseY);
                }
            }
        }
        //  鼠标松开
        function eventMouseUp(event) {
            // console.log('触点松开');
            var touchTarget = event.target;
            if (isSwipe) {
                SwipeLine.graphics.clear();
                SwipeLine.graphics.drawLine(TouchPoint.x, TouchPoint.y, touchTarget.mouseX, touchTarget.mouseY, "white", 20);
                Laya.stage.addChild(SwipeLine);
                //  缓动动画结束后,销毁划痕
                Tween.to(SwipeLine, { alpha: 0 }, 500, Laya.Ease.bounceIn, Handler.create(this, this.spriteDestroy, [SwipeLine]));
                if (isHit) {
                    //  扣血
                    PuddingData.Hp -= 1
                    if (PuddingData.Hp < 0) {
                        console.log(PuddingData.Hp);
                        //  划掉一个粽子
                        ++GameTotal
                        //  恢复最大血量
                        PuddingData.Hp = PuddingData.maxHp;
                        var puddingTotal = UIgameing.getChildByName('pudding_counter');
                        puddingTotal.text = GameTotal;
                        var totalLolly = UIgameing.getChildByName('total_counter').getChildByName('total_counter_lolly');
                        if (GameTotal < 15) {
                            Tween.to(totalLolly, { width: totalWidth / 15 * GameTotal }, 500)
                        } else {
                            // Tween.to(totalTop, { y: -20 }, null, 200)
                        }

                    }
                    ++touchTimes
                    //   弹出血量提示
                    if (touchTimes > randomLimitTIme) {
                        randomLimitTIme = Math.ceil(Math.random() * 5)
                        touchTimes = 0;
                        var hpTips = new Laya.Text();
                        // hpTips.text = 'Hp:' + PuddingData.Hp;
                        hpTips.text = GameWords[Math.ceil(Math.random() * GameWords.length - 1)];
                        hpTips.color = '#f7dc4a';
                        hpTips.fontSize = '64';
                        hpTips.font = 'Arial';
                        hpTips.bold = 800;
                        hpTips.pos(touchTarget.mouseX, UIgameing.height / 2);
                        UIgameing.addChildAt(hpTips, 0);
                        Tween.to(hpTips, { y: 300, alpha: 0 }, 1000, null, Handler.create(this, this.spriteDestroy, [hpTips]));
                    }
                    //  掉皮
                    var pee = 7 - PuddingData.Hp;
                    Pudding.showSlotSkinByIndex('body', pee);
                    Tween.to(PuddingSkinChip, { y: 200, alpha: 0, rotation: 720 }, 800, null, Handler.create(this, this.spriteDestroy, [PuddingSkinChip]));
                }
            }
            isTouch = isSwipe = isHit = false;
            isOnce = true;
            Laya.stage.off(Event.MOUSE_MOVE, this, eventMouseMove);
        }
    }
    /**
     * 游戏通关场景初始化...
     */
    this.stageOK = function () {
        console.log('游戏通关场景初始化...')
    }

    //  Sprite销毁 - 主要用于缓动动画之后自我销毁
    this.spriteDestroy = function (e) {
        // GarbageRes.push(e);
        e.destroy();
    }
    //  Sprite内对齐
    this.spriteAlign = function (e, mode = 'center') {
        switch (mode) {
            default:
                //  居中
                e.pivot(e.width / 2, e.height / 2);
        }
    }
    //  Sprite碰撞检测 - 用于划动与Sprite碰撞检测
    this.spriteCollision = function (e, point) {
        return e.hitTestPoint(point.x, point.y);
    }
}

