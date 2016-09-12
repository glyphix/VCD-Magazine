(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		jQuery(document).ready(function($) {
		  $("nav > ul").hide(); // Hide stuff on pageload
		  $(".menu-item").hide();
		  $(".back-issue").hide();

		  $(".menu-toggle").click(function() {
		  	if($(this).hasClass("selected") === false){

		  	  $(this).addClass("selected close background-color-3").removeClass("open");
		  	  $("h1.home-title").fadeOut(200);
		      $(".page-content").fadeOut(200);
		      $(".footer").fadeOut(200);
		      $("nav > ul").fadeIn(200);
		      $(".menu-item").delay(200).fadeIn(200);
		      $(".next-post").fadeOut(200);

		  	} else {

		  	  $(this).removeClass("selected close background-color-3").addClass("open");
		  	  $("h1.home-title").fadeIn(200);
		      $(".page-content").fadeIn(200);
		      $(".footer").fadeIn(200);
		      $("nav > ul").fadeOut(200);
		      $(".menu-item").fadeOut(200);
		      $(".older").removeClass("selected");
		      $(".older").next("li").slideUp(200).siblings("li").slideDown(200);
		      $(".next-post").fadeIn(200);
		  	}
		  });

		  $(".older").click(function() {
		  	if($(this).hasClass("selected") === false){

		  		$(this).addClass("selected");
		  		$(this).next("li").delay(100).slideDown(200).siblings("li").delay(100).slideUp(200);

		  	} else {

		  		$(this).removeClass("selected");
		  		$(this).next("li").delay(100).slideUp(200).siblings("li").delay(100).slideDown(200);
		  	}
		  });

		  

		});
	});
	
})(jQuery, this);
