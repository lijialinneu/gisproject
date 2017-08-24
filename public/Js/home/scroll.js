var SellerScroll = function(options) {
	this.SetOptions(options);
	this.lButton = this.options.lButton;
	this.rButton = this.options.rButton;
	this.oList = this.options.oList;
	this.showSum = this.options.showSum;

	this.iList = $("#" + this.options.oList + " > li");
	this.iListSum = this.iList.length;
	this.iListWidth = this.iList.outerWidth(true);
	this.moveWidth = this.iListWidth * this.showSum;

	this.dividers = Math.ceil(this.iListSum / this.showSum);

	this.moveMaxOffset = (this.dividers - 4) * this.moveWidth;

	this.LeftScroll();
	this.RightScroll();
	
};
SellerScroll.prototype = {
	SetOptions : function(options) {
		this.options = {
			lButton : "left_scroll",
			rButton : "right_scroll",
			oList : "carousel_ul",
			showSum : 1
		};
		$.extend(this.options, options || {});
	},
	ReturnLeft : function() {
		return isNaN(parseInt($("#" + this.oList).css("left"))) ? 0 : parseInt($("#" + this.oList).css("left"));
	},
	LeftScroll : function() {
		if (this.dividers == 1)
			return;
		var _this = this, currentOffset;
		$("#" + this.lButton).click(function() {
			currentOffset = _this.ReturnLeft();
			if(currentOffset!=0){
				$("#" + _this.oList + ":not(:animated)").animate({
					left : "+=" + _this.moveWidth
				}, "slow");
			}
			if ($('#range').val()>1){
				var val =parseInt($('#range').val())-1;
				if(val<=4){
					 var ul = $ ("ul#carousel_ul");
					 var imgs = ul.find ("li img");
				     var len = imgs.length;
					 $('#img_frame').css({
		    			 left :+(100+4.5) * (val-1)*len /  ($('#range').attr ("max")-1)+ "px"
		    		 });
				 }
				$('#range').val(val).slider("refresh");
			}
		});
	},
	RightScroll : function() {
		if (this.dividers == 1)
			return;
		var _this = this, currentOffset;
		$("#" + this.rButton).click(function() {
			currentOffset = _this.ReturnLeft();
			if (Math.abs(currentOffset) < _this.moveMaxOffset){
				$("#" + _this.oList + ":not(:animated)").animate({
					left : "-=" + _this.moveWidth
				}, "slow");
			}
			if($('#range').val()<11){
				var val =parseInt($('#range').val())+1;
				if(val>8){
					 var ul = $ ("ul#carousel_ul");
					 var imgs = ul.find ("li img");
				     var len = imgs.length;
					 $('#img_frame').css({
		    			 left :+(100+4.5) * (val-8)*len /  ($('#range').attr ("max")-1)+ "px"
		    		 });
				 }
				$('#range').val(val).slider("refresh");
			}
		});
	}
};