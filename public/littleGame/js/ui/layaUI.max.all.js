var CLASS$=Laya.class;
var STATICATTR$=Laya.static;
var View=laya.ui.View;
var Dialog=laya.ui.Dialog;
var gamingUI=(function(_super){
		function gamingUI(){
			
		    this.ani1=null;

			gamingUI.__super.call(this);
		}

		CLASS$(gamingUI,'ui.pudding.gamingUI',_super);
		var __proto__=gamingUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(gamingUI.uiView);

		}

		gamingUI.uiView={"type":"View","props":{"width":1536,"layoutEnabled":true,"height":2048},"child":[{"type":"Image","props":{"y":1250,"x":262,"skin":"game/leaf.png","scaleY":0.95,"scaleX":0.95,"centerX":0}},{"type":"Image","props":{"y":44,"x":722,"skin":"game/total_counter_bottom.png","scaleY":0.75,"scaleX":0.75,"name":"total_counter"},"child":[{"type":"Image","props":{"y":78,"x":29,"width":14,"skin":"game/total_counter_lolly.png","name":"total_counter_lolly","height":157}},{"type":"Image","props":{"y":1,"x":0,"skin":"game/total_counter_top.png","name":"total_counter_top"}}]},{"type":"Image","props":{"y":251,"x":738,"skin":"game/time_counter_bottom.png","scaleY":0.7,"scaleX":0.7,"name":"time_counter"}},{"type":"Image","props":{"y":288,"x":874,"width":18,"skin":"game/time_counter_lolly.png","name":"time_counter_lolly","height":102}},{"type":"Image","props":{"y":243,"x":728,"skin":"game/time_counter_top.png","scaleY":0.75,"scaleX":0.75,"name":"time_counter_top"}},{"type":"Label","props":{"y":302,"x":1291,"width":60,"visible":true,"text":"0","name":"time_number","layoutEnabled":false,"height":60,"fontSize":64,"font":"Arial","color":"#ffdb0f","anchorX":0,"align":"center"}},{"type":"Label","props":{"y":126,"x":1291,"width":60,"text":"0","skewX":0,"rotation":0,"name":"pudding_counter","height":60,"fontSize":64,"font":"Arial","color":"#ffdb0f","align":"center"},"compId":17},{"type":"Label","props":{"y":1604,"width":0,"text":"15秒内剥够8个粽子即过关!","height":0,"fontSize":64,"font":"Microsoft YaHei","color":"#000000","centerX":0,"align":"center"}},{"type":"Label","props":{"y":1600,"width":0,"text":"15秒内剥够8个粽子即过关!","height":0,"fontSize":64,"font":"Microsoft YaHei","color":"#ffdb0f","centerX":-4,"align":"center"},"compId":25}],"animations":[{"nodes":[{"target":17,"keyframes":{"y":[{"value":312,"tweenMethod":"linearNone","tween":true,"target":17,"key":"y","index":0}],"x":[{"value":350,"tweenMethod":"linearNone","tween":true,"target":17,"key":"x","index":0}],"text":[{"value":"9","tweenMethod":"linearNone","tween":true,"target":17,"key":"text","index":0}],"skewX":[{"value":0,"tweenMethod":"linearNone","tween":true,"target":17,"key":"skewX","index":0}],"rotation":[{"value":0,"tweenMethod":"linearNone","tween":true,"target":17,"key":"rotation","index":0}]}},{"target":25,"keyframes":{"text":[{"value":"——  15秒内剥够8个即过关  ——","tweenMethod":"linearNone","tween":false,"target":25,"key":"text","index":0}]}}],"name":"ani1","id":1,"frameRate":24,"action":0}]};
		return gamingUI;
	})(View);
var lostUI=(function(_super){
		function lostUI(){
			

			lostUI.__super.call(this);
		}

		CLASS$(lostUI,'ui.pudding.lostUI',_super);
		var __proto__=lostUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(lostUI.uiView);

		}

		lostUI.uiView={"type":"View","props":{"width":1536,"height":2048},"child":[{"type":"Image","props":{"y":1250,"x":262,"skin":"game/leaf.png","scaleY":0.95,"scaleX":0.95,"centerX":0}},{"type":"Label","props":{"y":521,"x":798,"width":136,"text":"0","strokeColor":"#1c2a2b","stroke":24,"name":"lost_counter","height":136,"fontSize":100,"font":"Arial","color":"#f36c07","bold":true,"align":"center"}},{"type":"Image","props":{"y":530,"width":849,"skin":"game/result.png","height":98,"centerX":3}},{"type":"Image","props":{"y":357,"skin":"game/failed.png","centerX":0}},{"type":"Image","props":{"y":1518,"skin":"game/recur.png","scaleY":0.82,"scaleX":0.82,"name":"restartBtn","centerX":0}}]};
		return lostUI;
	})(View);
var openViewUI=(function(_super){
		function openViewUI(){
			
		    this.animate=null;

			openViewUI.__super.call(this);
		}

		CLASS$(openViewUI,'ui.pudding.openViewUI',_super);
		var __proto__=openViewUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(openViewUI.uiView);

		}

		openViewUI.uiView={"type":"View","props":{"width":1536,"layoutEnabled":true,"height":2048},"child":[{"type":"Image","props":{"y":-66,"x":-89,"width":1747,"skin":"game/bgck.png","height":2154},"compId":17},{"type":"Image","props":{"y":1250,"skin":"game/leaf.png","scaleY":0.95,"scaleX":0.95,"centerX":0}},{"type":"Image","props":{"y":190,"width":975,"skin":"game/explain.png","scaleY":0.9,"scaleX":0.9,"height":319,"centerX":0}},{"type":"Label","props":{"y":1603,"text":"——  15秒内剥够8个即过关  ——","height":88,"fontSize":54,"color":"#ffffff","centerX":0,"align":"center"}},{"type":"Label","props":{"y":1673,"width":0,"text":"过关后联系客服","fontSize":56,"color":"#ffffff","centerX":0,"align":"center"}},{"type":"Label","props":{"y":1767,"text":"领取1个粽子","fontSize":56,"color":"#ffdb0f","centerX":0,"align":"center"}},{"type":"Image","props":{"y":712,"x":891,"width":518,"skin":"game/finger.png","height":351},"compId":12},{"type":"Image","props":{"y":713,"width":462,"skin":"game/pointTo.png","height":640,"centerX":-22}},{"type":"Box","props":{"y":320,"width":1044,"height":726,"centerX":0},"compId":18,"child":[{"type":"Image","props":{"x":303,"visible":false,"var":"3","skin":"game/3.png","centerY":0,"centerX":0},"compId":19},{"type":"Image","props":{"x":313,"visible":false,"var":"2","skin":"game/2.png","centerY":0,"centerX":0},"compId":20},{"type":"Image","props":{"x":336,"visible":false,"var":"1","skin":"game/1.png","centerY":0,"centerX":0},"compId":21},{"type":"Image","props":{"x":145,"visible":false,"skin":"game/Ready.png","name":"gameBeginBtn","centerY":0,"centerX":0},"compId":8},{"type":"Image","props":{"y":333,"x":364,"visible":true,"skin":"game/Go.png"},"compId":23}]}],"animations":[{"nodes":[{"target":8,"keyframes":{"x":[{"value":145,"tweenMethod":"linearNone","tween":true,"target":8,"key":"x","index":0}],"visible":[{"value":false,"tweenMethod":"linearNone","tween":false,"target":8,"key":"visible","index":0},{"value":true,"tweenMethod":"linearNone","tween":false,"target":8,"key":"visible","index":90},{"value":false,"tweenMethod":"linearNone","tween":false,"target":8,"key":"visible","index":120}]}},{"target":21,"keyframes":{"x":[{"value":336,"tweenMethod":"linearNone","tween":true,"target":21,"key":"x","index":0},{"value":336,"tweenMethod":"linearNone","tween":true,"target":21,"key":"x","index":60},{"value":336,"tweenMethod":"linearNone","tween":true,"target":21,"key":"x","index":90}],"visible":[{"value":false,"tweenMethod":"linearNone","tween":false,"target":21,"key":"visible","index":0},{"value":true,"tweenMethod":"linearNone","tween":false,"target":21,"key":"visible","index":60},{"value":false,"tweenMethod":"linearNone","tween":false,"target":21,"key":"visible","index":90}]}},{"target":20,"keyframes":{"x":[{"value":313,"tweenMethod":"linearNone","tween":true,"target":20,"key":"x","index":0},{"value":313,"tweenMethod":"linearNone","tween":true,"target":20,"key":"x","index":60}],"visible":[{"value":false,"tweenMethod":"linearNone","tween":false,"target":20,"key":"visible","index":0},{"value":true,"tweenMethod":"linearNone","tween":false,"target":20,"key":"visible","index":30},{"value":false,"tweenMethod":"linearNone","tween":false,"target":20,"key":"visible","index":60}]}},{"target":19,"keyframes":{"x":[{"value":303,"tweenMethod":"linearNone","tween":true,"target":19,"key":"x","index":0},{"value":303,"tweenMethod":"linearNone","tween":true,"target":19,"key":"x","index":30}],"visible":[{"value":true,"tweenMethod":"linearNone","tween":false,"target":19,"key":"visible","index":0},{"value":false,"tweenMethod":"linearNone","tween":false,"target":19,"key":"visible","index":30}]}},{"target":12,"keyframes":{"y":[{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"key":"y","index":0},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"key":"y","index":15},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":16},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":30},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":31},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":45},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":46},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":60},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":61},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":75},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":76},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":90},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":91},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":105},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":106},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":120},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":121},{"value":712,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":135},{"value":1247,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"y","index":136}],"x":[{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"key":"x","index":0},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"key":"x","index":15},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":16},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":30},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":31},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":45},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":46},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":60},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":61},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":75},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":76},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":90},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":91},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":105},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":106},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":120},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":121},{"value":891,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":135},{"value":543,"tweenMethod":"linearNone","tween":true,"target":12,"label":null,"key":"x","index":136}]}},{"target":17,"keyframes":{"x":[{"value":-89,"tweenMethod":"linearNone","tween":true,"target":17,"key":"x","index":0}],"width":[{"value":1747,"tweenMethod":"linearNone","tween":true,"target":17,"key":"width","index":0}]}},{"target":18,"keyframes":{"width":[{"value":1536,"tweenMethod":"linearNone","tween":true,"target":18,"key":"width","index":0},{"value":1044,"tweenMethod":"linearNone","tween":true,"target":18,"key":"width","index":95}]}},{"target":23,"keyframes":{"y":[{"value":268,"tweenMethod":"linearNone","tween":true,"target":23,"key":"y","index":0},{"value":333,"tweenMethod":"linearNone","tween":true,"target":23,"key":"y","index":120}],"x":[{"value":595,"tweenMethod":"linearNone","tween":true,"target":23,"key":"x","index":0},{"value":364,"tweenMethod":"linearNone","tween":true,"target":23,"key":"x","index":120},{"value":364,"tweenMethod":"linearNone","tween":true,"target":23,"key":"x","index":135}],"visible":[{"value":false,"tweenMethod":"linearNone","tween":false,"target":23,"key":"visible","index":0},{"value":true,"tweenMethod":"linearNone","tween":false,"target":23,"key":"visible","index":120}]}}],"name":"animate","id":2,"frameRate":30,"action":0}]};
		return openViewUI;
	})(View);
var startUI=(function(_super){
		function startUI(){
			
		    this.ani1=null;

			startUI.__super.call(this);
		}

		CLASS$(startUI,'ui.pudding.startUI',_super);
		var __proto__=startUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(startUI.uiView);

		}

		startUI.uiView={"type":"View","props":{"width":1536,"height":2048},"child":[{"type":"Image","props":{"y":656,"x":803,"skin":"game/message.png"}},{"type":"Image","props":{"y":1250,"skin":"game/leaf.png","scaleY":0.95,"scaleX":0.95,"centerX":0}},{"type":"Image","props":{"y":159,"skin":"game/solgan.png","scaleY":1.05,"scaleX":1.05,"centerX":0}},{"type":"Image","props":{"y":1518,"skin":"game/startBtn.png","scaleY":0.82,"scaleX":0.82,"name":"gameStarted","centerX":0}},{"type":"Box","props":{"width":800,"visible":false,"name":"loadngBox","height":800,"centerY":70,"centerX":0},"child":[{"type":"Image","props":{"y":487,"x":256,"skin":"game/LOADING.png"},"compId":10},{"type":"Image","props":{"y":212,"x":248,"skin":"game/zongzi.png"},"compId":11}]}],"animations":[{"nodes":[{"target":11,"keyframes":{"y":[{"value":212,"tweenMethod":"linearNone","tween":true,"target":11,"key":"y","index":0},{"value":160,"tweenMethod":"linearNone","tween":true,"target":11,"key":"y","index":10},{"value":212,"tweenMethod":"linearNone","tween":true,"target":11,"label":null,"key":"y","index":20}],"x":[{"value":248,"tweenMethod":"linearNone","tween":true,"target":11,"key":"x","index":0},{"value":248,"tweenMethod":"linearNone","tween":true,"target":11,"key":"x","index":10},{"value":248,"tweenMethod":"linearNone","tween":true,"target":11,"label":null,"key":"x","index":20}]}},{"target":10,"keyframes":{"x":[{"value":256,"tweenMethod":"linearNone","tween":true,"target":10,"key":"x","index":0},{"value":256,"tweenMethod":"linearNone","tween":true,"target":10,"key":"x","index":10},{"value":256,"tweenMethod":"linearNone","tween":true,"target":10,"label":null,"key":"x","index":20}],"alpha":[{"value":1,"tweenMethod":"linearNone","tween":true,"target":10,"key":"alpha","index":0},{"value":0,"tweenMethod":"linearNone","tween":true,"target":10,"key":"alpha","index":10},{"value":1,"tweenMethod":"linearNone","tween":true,"target":10,"label":null,"key":"alpha","index":20}]}}],"name":"ani1","id":1,"frameRate":24,"action":2}]};
		return startUI;
	})(View);
var winUI=(function(_super){
		function winUI(){
			
		    this.ani1=null;

			winUI.__super.call(this);
		}

		CLASS$(winUI,'ui.pudding.winUI',_super);
		var __proto__=winUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(winUI.uiView);

		}

		winUI.uiView={"type":"View","props":{"width":1536,"height":2048},"child":[{"type":"Image","props":{"y":1250,"x":235,"skin":"game/leaf.png","centerX":0}},{"type":"Sprite","props":{"y":0,"x":0}},{"type":"Box","props":{"y":0,"x":0}},{"type":"Box","props":{"y":0,"x":0,"width":1536,"name":"box","height":1497},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1536,"skin":"game/fl.png","scaleY":1,"scaleX":1,"alpha":0.4},"compId":10},{"type":"Label","props":{"y":442,"x":740,"width":173,"text":"0","strokeColor":"#1c2a2b","stroke":12,"name":"win_counter","height":80,"fontSize":100,"font":"Arial","color":"#f36c07","bold":true,"align":"center"}},{"type":"Image","props":{"y":271,"x":207,"skin":"game/gongxi.png","centerX":0}}]}],"animations":[{"nodes":[{"target":10,"keyframes":{"x":[{"value":0,"tweenMethod":"linearNone","tween":true,"target":10,"key":"x","index":0},{"value":0,"tweenMethod":"linearNone","tween":true,"target":10,"key":"x","index":10},{"value":0,"tweenMethod":"linearNone","tween":true,"target":10,"key":"x","index":20}],"alpha":[{"value":1,"tweenMethod":"linearNone","tween":true,"target":10,"key":"alpha","index":0},{"value":0,"tweenMethod":"linearNone","tween":true,"target":10,"key":"alpha","index":10},{"value":1,"tweenMethod":"linearNone","tween":true,"target":10,"key":"alpha","index":20}]}}],"name":"ani1","id":1,"frameRate":24,"action":2}]};
		return winUI;
	})(View);