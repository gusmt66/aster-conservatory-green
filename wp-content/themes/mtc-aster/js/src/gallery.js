(function () {
  //"use strict";

	var galleryJSON,
			galleryContainer = $('#gallery'),
			imagesContainer = $('#image-container'),
			categoriesContainer = $('#categories'),
			buildingsContainer = $('#buildings'),
			radioButtons = $('.form-radio label');

	/**
	 *  Populates categories and buildings
	 **/
	function populateCategories(){
		var found,
				buildings = [],
				categories = [];

		for (var i = 0; i <= galleryJSON.length - 1; i++) {
			
			//buildings
			var li = $(document.createElement("li")),
		      div = $(document.createElement("div")),
		      lbl = $(document.createElement("label")),
		      inp = $(document.createElement("input"));

			found = buildings.filter(function(element) {
			  return element.trim().toLowerCase() == galleryJSON[i].building.trim().toLowerCase();
			});
			if(typeof found === 'undefined' || found.length == 0){
				buildings.push(galleryJSON[i].building);
	      div.addClass('form-radio');
	      lbl.attr({'for':'radio-'+i});
	      inp.attr({'id':'radio-'+i,'type':'radio','value':galleryJSON[i].building});
	      inp.html(galleryJSON[i].building);
      	lbl.html(inp);
      	div.append(lbl);
      	div.append(galleryJSON[i].building);
      	buildingsContainer.append(div);
			}

			//categories
			var li = $(document.createElement("li")),
					div = $(document.createElement("div"));

			found = categories.filter(function(element) {
			  return element.trim().toLowerCase() == galleryJSON[i].category.trim().toLowerCase();
			});
			if(typeof found === 'undefined' || found.length == 0){
				categories.push(galleryJSON[i].category);
				div.addClass('text');
				div.html(galleryJSON[i].category);
				li.html(div);
				categoriesContainer.append(li);	
			}
		}
	}

  /**
  * Populates images
  */
	function populateImages(images){
		imagesContainer.empty();
		for (var i = 0; i <= images.length - 1; i++) {
			//images
			var a =	$(document.createElement("a")),
					img = $(document.createElement("img"));
			a.attr({'href':images[i].url,'data-title':images[i].caption});
			img.addClass('responsive-img');
			img.attr({'src':images[i].medium});
			img.attr({'data-l':images[i].thumb});
			img.attr({'data-d':images[i].thumb});
			img.attr({'data-t':images[i].thumb});
			img.attr({'data-m':images[i].medium});
			a.append(img);
			imagesContainer.append(a);
		}
	}

  /**
  * Adds the event listeners to the necessary elements
  */
	function addingListeners() {
    $('.form-radio label').on({
      click:function(){
        $('.form-radio label').removeClass('clicked');
        $(this).addClass('clicked');
        var currentCategory = getActiveCategory();
        var currentBuilding = $(this).find('input').val();
        filterImages(currentBuilding, currentCategory);
      }
    });

    categoriesContainer.find('li').on({
      click:function(){
      	categoriesContainer.children('li').removeClass('active');
        $(this).addClass('active');
        var currentCategory = $(this).find('div').html();
        var currentBuilding = getActiveBuilding();
        filterImages(currentBuilding, currentCategory);
      }
    });
  }

  /**
  * Displays the list of images filtered by the selected building and category
  */
  function filterImages(building,category){

		if(building.toLowerCase() == 'all' && category.toLowerCase() == 'all'){
				populateImages(galleryJSON);
  	}else{
	  	var filteredImages = galleryJSON.filter(function(elem){
	  		if(building.toLowerCase() != 'all' && category.toLowerCase() != 'all'){
	  			return elem.building == building && elem.category == category;
	  		}else if(building.toLowerCase() != 'all'){
					return elem.building == building;
	  		}else{
	  			return elem.category == category;
	  		}
	  	});
	  	populateImages(filteredImages);
  	}
  }

  /**
  * Gets the Building radio button that is active
  */
  function getActiveBuilding(){
  	var output;
  	$('.form-radio label').each(function(index){
  		if ($(this).hasClass('clicked')){
  			output = $(this).find('input').val();
  		}
  	});
  	return output;
  }

  /**
  * Gets the Category that is active
  */
  function getActiveCategory(){
  	var output;
  	categoriesContainer.find('li').each(function(index){
  		if ($(this).hasClass('active')){
  			output = $(this).find('div').html();
  		}
  	});
  	return output;
  }

  /**
  * Initialize the Gallery container with the library Featherlight
  */
	function initContainer(){
		imagesContainer.attr({
        'data-featherlight-gallery':'',
        'data-featherlight-filter':'a'
    });

    imagesContainer.featherlightGallery({
        previousIcon: '<i class="fas fa-angle-left"></i>',
        nextIcon: '<i class="fas fa-angle-right"></i>',
        galleryFadeIn: 300,
        openSpeed: 300
    });
	}

  function init(){
    $.ajax({
      cache:false,
      url:templateURL + "/JSON/gallery.json",
      dataType:"json",
      success:function(data){
        galleryJSON = data;
        console.log(galleryJSON);
        initContainer();
        populateCategories();
        populateImages(galleryJSON);
        addingListeners();
      }
    });
  }

  /**
  * Function to add a caption to the current displayed image
  * More info: https://github.com/noelboss/featherlight/wiki/Gallery:-showing-a-caption
  */
  $.featherlightGallery.prototype.afterContent = function() {
    var caption = this.$currentTarget.attr('data-title');
    this.$instance.find('.caption').remove();
    if(caption){
      $('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
      
      $('.caption').fadeIn(300,function(){
        //nothing;
      });
    }
  };

  $(document).ready(function(){
    init();
  });

}());