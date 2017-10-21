var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.03em solid black}";
        document.body.appendChild(css);
    };

//Konsola 

$("input").keypress(function(event) {
    if(event.which === 13) {
        if($(this).val() == "info") {
            $(".infoConsol").text("With our website you can give your bookmarks to a private database. This makes it easy and fun to find them quickly and easily.");
            $(this).val("");
        }
        
        else if($(this).val() == "clear") {
            $(".infoConsol").text("");
            $(this).val("");
        }
        
        else if($(this).val() == "author") {
            $(".infoConsol").text("The author of this site is: Rafal Podraza");
            $(this).val("");
        }
        
        
        else if($(this).val() == "help") {
            $(".infoConsol").text("-info - Information about the site | -author - About the author of the site | -clear - This command clears the console screen");
            $(this).val("");
        }        
        
        else {
            
            $(".infoConsol").text("-bash: " +$("input").val()+": " + "command not found");
            $(this).val("");
        }
    }
    
});

$(".circleClose").click(function() {
    $(".console").fadeOut(600);
    $(".btnConsole").fadeToggle(500).removeClass("btnAttr");
});

$(".btnConsole").click(function() {
   $(".console").fadeToggle(600);
    $(this).fadeOut(600);
});

$(".btnInfo").click(function() {
   $(".displayInfo").fadeToggle(700); 
});

$(document).ready(function(){
 
		$('*[data-animate]').addClass('hideX').each(function(){
      $(this).viewportChecker({
        classToAdd: 'show animated ' + $(this).data('animate'),
        classToRemove: 'hideX',
        offset: '30%'
      });
    });
 
});

//Przeiwjanie płynne zakładki

$(document).ready(function() { 
 
	$('a[href^="#"]').on('click', function(event) {
	
		var target = $( $(this).attr('href') );
	
		if( target.length ) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: target.offset().top
			}, 1000);
		}
	});
 
});

//Wyszukiwanie 
(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
					if(search == '') {
						$rows.show(); 
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();
	
	$('.container').on('click', '.panel-heading span.filter', function(e){
		var $this = $(this), 
			$panel = $this.parents('.panel');
		
		$panel.find('.panel-body').slideToggle();
		if($this.css('display') != 'none') {
			$panel.find('.panel-body input').focus();
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
});

$("#btnadd").click(function() {
   $(".addnone").fadeToggle(700); 
});

$("#btndelete").click(function() {
   $(".deletenone").fadeToggle(700); 
});

//Info Points Button
$("#btninfopoints").click(function() {
   alert("50 POINTS FOR ADDING THE LINK!\nPoints will be visible after re-login!".toUpperCase()); 
});