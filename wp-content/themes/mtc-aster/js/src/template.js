(function(){
    "use strict";
}());

  var ariaExpanded = '',
  		ariaPressed = '',
  		ariaLabel = '',
  		isMobileWidth = false;

	function checkMobileWidth(){
	  isMobileWidth = ($(window).width() <= 768);
	}	

  // Menu actions
  function menu() {
  	var navigation = $("#navigation-container"),
  			navTrigger = $("#nav-trigger"),
  			navItems = $(".inner-container").find("a"),
  			slideoutBtn = $("#slideout1 .button-wrap, #slideout2 .button-wrap, #slideout2 form input");

  			navItems.prop('tabindex', -1); //Default

		    navTrigger.on('click keyup',function(event){
					if (typeof event.keyCode === 'undefined' || event.keyCode === 13) { //Click or Enter key.
		        navigation.toggleClass('active');
		        $(this).toggleClass('active');

			      // 508
			      ariaExpanded = navigation.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
			      ariaPressed = navigation.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
			      ariaLabel = navigation.hasClass('active') ? 'Close Navigation' : 'Open Navigation'; // Determine if the content is hidden or shown

			      navigation.attr('aria-expanded', ariaExpanded); // Set the aria-expanded attribute accordingly
			      navTrigger.attr('aria-pressed', ariaPressed); // Set the aria-pressed attribute accordingly
			      navTrigger.attr('aria-label', ariaLabel); // Set the aria-label attribute accordingly

		        if(ariaExpanded == 'true'){
		        	$('a, button, input').prop('tabindex', -1); //remove tabindex on everything...
		        	slideoutBtn.prop('tabindex', -1);
		        	navItems.prop('tabindex', 0); //...except for the inner container
		        }else{
		        	$('a, button, input').prop('tabindex', 0);
		        	slideoutBtn.prop('tabindex', 0);
		        	navItems.prop('tabindex', -1);
		        }

					}
			  });
  }

  //Slideouts - Desktop
  function slideout(slideoutId){

    var id = '#' + slideoutId; //slideout1, slideout2

    var trigger = $(id + " .button-wrap"),
        slideout = $(id),
        iconClose = $(id + " .icon-close"),
        inputs = $(id + " form input");

    //Default values
    iconClose = $(id + " .icon-close").prop('tabindex', -1);
    inputs.prop('tabindex', -1);

    trigger.on('click keyup', function(event){

      if (typeof event.keyCode === 'undefined' || event.keyCode === 13) { // Click or Enter key.

        // event.stopPropegation();
        slideout.toggleClass("active");

        // 508
        ariaExpanded = slideout.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
        ariaPressed = slideout.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
        ariaLabel = slideout.hasClass('active') ? 'Close Special Content' : 'Open Special Content'; // Determine if the content is hidden or shown

        slideout.attr('aria-expanded', ariaExpanded); // Set the aria-expanded attribute accordingly
        trigger.attr('aria-label', ariaLabel); // Set the aria-expanded attribute accordingly
        trigger.attr('aria-pressed', ariaPressed); // Set the aria-expanded attribute accordingly

        if(ariaExpanded == 'true'){
          iconClose.prop('tabindex', 0);
          inputs.prop('tabindex', 0);
        }else{
          iconClose.prop('tabindex', -1);
          inputs.prop('tabindex', -1);
        }
       event.preventDefault();
      }

    });

    iconClose.on('click keypress',function(event){
      if (typeof event.keyCode === 'undefined' || event.keyCode === 13) { //Click or Enter key.
        slideout.toggleClass("active");
        slideout.attr('aria-expanded', 'false');  // Set back to false when closing.
      }
    });

  }

  // Slideouts - Mobile
  function slideout_mobile(slideoutId){

    var id = '#' + slideoutId + '-mobile'; //slideout1-mobile, slideout2-mobile

    var trigger = $(id + " .button-wrap"),
        slideout = $(id),
        iconClose = $(id + " .icon-close"),
        content = $(id + " .slideout-inner-wrap");

        iconClose = $(id + " .icon-close").prop('tabindex', -1); // Default

    trigger.on('click keyup', function(event){

      if (typeof event.keyCode === 'undefined' || event.keyCode === 13) { // Click or Enter key.

        if(slideout.hasClass('active-mobile')){
          slideout.removeClass("active-mobile");
        }else{
          //reset the slideouts content
          $('.slideouts-container-mobile').children('div').removeClass("active-mobile");
          // and then activating the one clicked
          slideout.addClass("active-mobile");
        }

        // 508
        ariaExpanded = slideout.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
        ariaPressed = slideout.hasClass('active') ? 'true' : 'false'; // Determine if the content is hidden or shown
        ariaLabel = slideout.hasClass('active') ? 'Close Special Content' : 'Open Special Content'; // Determine if the content is hidden or shown

        slideout.attr('aria-expanded', ariaExpanded); // Set the aria-expanded attribute accordingly
        trigger.attr('aria-label', ariaLabel); // Set the aria-expanded attribute accordingly
        trigger.attr('aria-pressed', ariaPressed); // Set the aria-expanded attribute accordingly

        if(ariaExpanded == 'true'){
          iconClose.prop('tabindex', 0);
        }else{
          iconClose.prop('tabindex', -1);
        }
       event.preventDefault();
      }

    });

    iconClose.on('click keypress',function(event){
      if (typeof event.keyCode === 'undefined' || event.keyCode === 13) { //Click or Enter key.
        slideout.toggleClass("active");
        slideout.attr('aria-expanded', 'false');  // Set back to false when closing.
      }
    });

  }


  // Responsive images
  function resizeImages(){
    // Responsive Image
    $('.responsive-img').each(function(){
      var large = $(this).attr('data-l'),
      		desktop = $(this).attr('data-d'),
          tablet = $(this).attr('data-t'),
          mobile = $(this).attr('data-m');
      if($(window).width() < 767) {
        $(this).attr('src', tablet );
      } else if($(window).width() < 1023) {
        $(this).attr('src', desktop );
      } else if($(window).width() < 1680) {
        $(this).attr('src', large );
      } else {
        $(this).attr('src', large );
      }
    });
  }

  function resizeSliderImages(){
  	var slide = $('.slide-image').children('img'),
  			totalWidth = $(window).width();

  	var newHeight = (9 * totalWidth) / 16; //To match Aspect Ratio of 16/9

  	slide.css('height',newHeight);

  }

  /**
  * Relocates headline, subheadline and slideouts
  */
  function relocateHeaderElements(){

    var slideout1 = $("#slideout1"),
        slideout2 = $("#slideout2"),
        slideout_content1 = $("#slideout1").find(".slideout-inner-wrap"),
        slideout_content2 = $("#slideout2").find(".slideout-inner-wrap"),
        slide = $('.slide-image').children('img'),
        headline = $('.headline-container'),
        arrow = $('.anchor-arrow');

        slideout1.removeClass("active");
        slideout2.removeClass("active");

    //Headline and subheadline
    var slideWidth = slide.width();
    var slideHeight = (slideWidth * 9) / 16;
    var pos = (slideHeight / 2) - (headline.height() / 2);
    headline.css({'top':pos});

    //calc position based on the first slideout
    if(isMobileWidth){

      var slideout1_m = $("#slideout1-mobile"),
          slideout2_m = $("#slideout2-mobile");

      slideout1_m.removeClass("active-mobile");
      slideout2_m.removeClass("active-mobile");
      
    }else{

      //Desktop slideouts
      if(headline.length == 0){
        var slideoutsHeight = slideout1.outerHeight() + slideout2.outerHeight();
        pos = ($(window).height() / 2) -  (slideoutsHeight / 2);
      }

      var h = pos + slideout1.outerHeight();
      
      slideout1.css({'top':pos + 'px','left':'auto'});
      slideout2.css({'top':h + 'px'});

      //anchor-arrow
      var position = pos + headline.height() + 40;
      arrow.css({'top':position});
      
    }
  }

  /**
  * Function to highlight radio buttons on forms (contact form)
  **/
  function highlight_radio() {
    $('.frm_opt_container label').on({
      click:function(){
        $('.frm_opt_container label').removeClass('clicked');
        $(this).addClass('clicked');
      }
    });
  }

  /**
  * Add event listeners
  **/
  function addListeners(){
    //adding event listener to anchor arrow on hero image
    $("#anchor-arrow").on('click', function(event) {
      if (this.hash !== "") {
        event.preventDefault();

        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){

          window.location.hash = hash;
        });
      }
    });    
  }

  /**
  * Detects Browser and adapt images with object-fit or background css accordingly.
  **/
  function adaptImages(){
    if ( ! Modernizr.objectfit ) {
      //general images and blog posts' images
      $('.object-fit-container, .post .post-content .image').each(function () {
        var $container = $(this),
            imgUrl = $container.find('img').prop('src');
        if (imgUrl) {
          $container
            .css('backgroundImage', 'url(' + imgUrl + ')')
            .addClass('bg-cover');
        }  
      });
    }
  }

  /**
  * Makes the header fixed when the screen is scrolled
  **/
  function animateHeader() {
    var body = $('body'),
        header = $('#header'),
        dummy = $('#dummy'),
        navTrigger = $('#nav-trigger'),
        scroll = $(document).scrollTop();

    if(body.hasClass('page-online-leasing')){
        //static header
        header.addClass('scroll');
        dummy.addClass('scroll');
        navTrigger.addClass('scroll');

    }else{
      //animate header
      if(scroll > 0){
        header.addClass('scroll');
        dummy.addClass('scroll');
        navTrigger.addClass('scroll');
      } else if(scroll < 25) {
        header.removeClass('scroll');
        dummy.removeClass('scroll');
        navTrigger.removeClass('scroll');
      }

    }
  }

/* FOR PARALLAX */
  //returns the width and height of the browser viewable area
  function alertSize(v) {
    var myWidth = 0, myHeight = 0;
    if( typeof( window.innerWidth ) == 'number' ) {
      //Non-IE
      myWidth = window.innerWidth;
      myHeight = window.innerHeight;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
      //IE 6+ in 'standards compliant mode'
      myWidth = document.documentElement.clientWidth;
      myHeight = document.documentElement.clientHeight;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
      //IE 4 compatible
      myWidth = document.body.clientWidth;
      myHeight = document.body.clientHeight;
    }
    if(v == "w"){
      return(myWidth);
    }else if(v == "h"){
      return(myHeight);
    }
  }

  function skrollrInit(){
      if (!((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) || (alertSize('w') < 769))){
          s = skrollr.init({
              forceHeight:false,
              smoothScrolling:false
          });
      }else if (typeof s != "undefined"){
          s.destroy();
      }
  }
/* END - FOR PARALLAX */


  // Do stuff on document ready
	$(document).ready(function(){
    skrollrInit();
    checkMobileWidth();
		menu();
    slideout('slideout1');
    slideout('slideout2');
    slideout_mobile('slideout1');
    slideout_mobile('slideout2');
    relocateHeaderElements();
		resizeImages();
		resizeSliderImages();
    highlight_radio();
    addListeners();
    adaptImages();

    /* fix for online leasing page */
    var body = $('body'),
        header = $('#header'),
        dummy = $('#dummy'),
        navTrigger = $('#nav-trigger');
    if(body.hasClass('page-online-leasing')){
        header.addClass('scroll');
        dummy.addClass('scroll');
        navTrigger.addClass('scroll');
    }
    /* */

	});

	$(window).on({
	  resize:function(){
      skrollrInit();
			checkMobileWidth();
      relocateHeaderElements();
			resizeImages();
			resizeSliderImages();
      adaptImages();
	  },
    // Do stuff on Window scroll
    scroll:function(){
      animateHeader();
    }
	})

// fire form submission success event after Formidable contact form submission
function frmThemeOverride_frmAfterSubmit(formReturned, pageOrder, errObj, object){
    if(typeof(formReturned) == 'undefined'){
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'formSubmissionSuccess',
            formId: 'contactForm'
        });
    }
}