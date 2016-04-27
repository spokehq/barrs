(function($,undefined){

  var components = [];

  // ~ Form Shim ~ //
  $('#subForm input').on('focus', function(){
    $(this).attr('placeholder', '');
  });

  $('#subForm input').on('blur', function(){
    $(this).attr('placeholder', 'Enter Your Email Address');
  });

  $('#subForm > a').on('click', function(e){
    e.preventDefault();
    $(this).closest('form').submit();
  });

  // ~ Events Component ~ //
  
  var EventsComponent = function($component){
    this.$window = $(window);
    this.$eventItems = $component.find('.list-event');
    this.$eventItems.on('click', $.proxy(this.onItemClick,this));
    this.$window.on('hashchange', $.proxy(this.onHashChange,this))
      .trigger('hashchange');
  };

  EventsComponent.className = ".events-component";

  EventsComponent.prototype.onItemClick = function(e) {
    var $eventItem = $(e.target).closest('.list-event');
    $eventItem.hide();
    window.location.hash = $eventItem.attr('id');
    $eventItem.show();
    this.setActive($eventItem);
  };

  EventsComponent.prototype.onHashChange = function() {
    var hash = window.location.hash;
    this.setActive($(hash));
  };

  EventsComponent.prototype.setActive = function($targetItem){
    if($targetItem.length > 0){
      this.$eventItems.removeClass('active');
      $targetItem.addClass('active');
    }
  };

  components.push(EventsComponent);

  // ~ End Events Component ~ //

  // ~ Background Component ~ //
  var BackgroundComponent = function($component){
    var path = "/wp-content/themes/barrs/library/backgrounds/";
    var bgidx = Math.floor(Math.random() * this.backgrounds.length);
    var bgurl = "url("+path+this.backgrounds[bgidx]+")";
    $component.css("background-image",bgurl);
  };

  BackgroundComponent.className = ".background-component";
  //Add backgrounds here!!
  BackgroundComponent.prototype.backgrounds = [ 
    "bg1.jpg", "bg2.jpg", "bg3.jpg", "bg4.jpg", "bg5.jpg", "bg6.jpg", "bg7.jpg", "bg8.jpg"
  ];

  components.push(BackgroundComponent);

  // ~ End Background Component ~ //

  // ~ Menu Nav Component ~ //

  var MenuNavComponent = function($component) {
    this.$container = $component.closest('article');
    this.$component = $component;
    this.$cpWrapper = $component.find('.inner-wrapper');
    this.$navItems  = $component.find('a');
    this.$window    = $(window);
    this.scrollDur  = 0.10; //second
    this.scrollStep = 0;
    this.scrollCnt  = 0;
    this.isScroll   = false;
    this.$cpWrapper.toggleClass('snapped',true);
    this.origTop    = this.$cpWrapper.offset().top;
    this.$component.height(this.$component.outerHeight());

    this.$navItems.on('click',$.proxy(this.onNavClick,this));
  };

  MenuNavComponent.className = ".menu-nav-component";

  MenuNavComponent.prototype.update = function() {
    var scrollTop = this.$window.scrollTop();
    var parentTop = scrollTop - this.origTop;

    this.$cpWrapper.toggleClass('snapped',(parentTop < this.origTop));

    if(this.scrollCnt <= 0){
      this.isScroll = false;
    }

    if(this.isScroll){
    	// if menu has 2 lines, offset + extra pixels
		var menuHeight = $('.menu-nav-component .inner-wrapper').height();
		if (menuHeight > 70) {
			//alert ('this menu is two lines');
			this.$window.scrollTop(scrollTop + this.scrollStep-12);
      		this.scrollCnt -= 1;	
		} else {
			this.$window.scrollTop(scrollTop + this.scrollStep-15);
      		this.scrollCnt -= 1;
		}
    }
  };

// if menu has 2 lines, offset + extra pixels
/*var menuHeight = $('.menu-nav-component .inner-wrapper').height();
alert (menuHeight);
if (menuHeight > 70) {
	alert ('it is taller than');
	
}*/

  MenuNavComponent.prototype.onNavClick = function(e) {
    e.preventDefault();
    var $target = $(e.target);
    this.$navItems.removeClass('active');
    var scrollDest = $($target.attr('href')).offset().top;
    $target.addClass('active');
    this.calcScroll(scrollDest - 25 - this.$window.scrollTop());
  };

  MenuNavComponent.prototype.calcScroll = function(scrollDist) {
    this.scrollStep = scrollDist / (this.scrollDur*60);
    this.scrollCnt  = scrollDist / this.scrollStep;
    this.isScroll = true;
  };

  components.push(MenuNavComponent);

  // ~ Slider Component ~ //

  var SliderComponent = function($component){
    this.$imageList      = $component.find('.image-list').find('li');
    this.$sliderControls = $component.find('.slider-controls');
    this.$bullets        = this.$sliderControls.find('.bullets');
    this.$sliderControls.on('click',$.proxy(this.onNavClick,this));
    this.$imageList.each($.proxy(this.addNavLink,this));
    this.$imageList.hide();
    this.count = this.$imageList.length;
    if(this.count <= 1){
      this.$sliderControls.hide();
    }

    this.idx = 0;

    this._changeSlide();
  };

  SliderComponent.className = ".slider-component";

  SliderComponent.prototype.addNavLink = function(index) {
    var $link = $(document.createElement('a'));
    $link.attr('href','#');
    $link.data('index',index);
    this.$bullets.append($link);
  };

  SliderComponent.prototype.changeSlide = function(num) {
    this.idx = (this.idx + num)%this.count;
    if(this.idx < 0){
      this.idx = this.count - 1;
    }
  };

  SliderComponent.prototype._changeSlide = function() {
    var $slide = this.$imageList.eq(this.idx);
    this.$imageList.closest('.image-list').height($slide.outerHeight());
    this.$imageList.fadeOut();
    $slide.fadeIn();
    this.$bullets.find('a').removeClass('active').eq(this.idx).addClass('active');
    this.positionArrows();
  };

  SliderComponent.prototype.positionArrows = function() {
    var mainHeight = this.$imageList.eq(this.idx)[0].offsetHeight;
    var arrowHeight = this.$sliderControls.find('.left').height();
    var newHeight = (mainHeight/2) - (arrowHeight/2);

    this.$sliderControls.find('.left').css({
      top:newHeight
    });

    this.$sliderControls.find('.right').css({
      top:newHeight
    });
  };

  SliderComponent.prototype.onNavClick = function(e) {
    var $target = $(e.target);
    var index = $target.data('index');

    if(typeof index === "number"){
      this.idx = index;
    }

    if($target.hasClass('left')){
      this.changeSlide(-1);
    }

    if($target.hasClass('right')){
      this.changeSlide(1);
    }

    if($target[0].tagName === "A"){
      this._changeSlide();
    }
    
    e.preventDefault();
  };

  components.push(SliderComponent);

  // Bootstrap //
  var activeComponents = [];
  $.each(components,function(index,Component){
    var $component = $(Component.className);
    if($component.length > 0){
      $component.each(function(index,element){
        activeComponents.push(new Component($(element)));
      });
    }
  });

  // Update Loop //
  (function animloop(){
    requestAnimFrame(animloop);
    $.each(activeComponents,function(index,component){
      if(component.update){
        component.update();
      }
    });
  })();

	// placeholder text for IE lower than 10
	if(navigator.appVersion.match(/MSIE [\d.]+/)){
   	 	var placeholderText = 'Enter Your Email Address';
    	$('#jllkwl-jllkwl').val(placeholderText);
    	$('#jllkwl-jllkwl').blur(function(){
        	$(this).val() == '' ? $(this).val(placeholderText) : false;
    	});
    	$('#jllkwl-jllkwl').focus(function(){
        	$(this).val() == placeholderText ? $(this).val('') : false;
    	});
	}
}(jQuery));
