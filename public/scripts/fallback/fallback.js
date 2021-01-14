!window.addEventListener && (function (WindowPrototype, DocumentPrototype, ElementPrototype, addEventListener, removeEventListener, dispatchEvent, registry) {
	WindowPrototype[addEventListener] = DocumentPrototype[addEventListener] = ElementPrototype[addEventListener] = function (type, listener) {
		var target = this;

		registry.unshift([target, type, listener, function (event) {
			event.currentTarget = target;
			event.preventDefault = function () { event.returnValue = false };
			event.stopPropagation = function () { event.cancelBubble = true };
			event.target = event.srcElement || target;

			listener.call(target, event);
		}]);

		this.attachEvent("on" + type, registry[0][3]);
	};

	WindowPrototype[removeEventListener] = DocumentPrototype[removeEventListener] = ElementPrototype[removeEventListener] = function (type, listener) {
		for (var index = 0, register; register = registry[index]; ++index) {
			if (register[0] == this && register[1] == type && register[2] == listener) {
				return this.detachEvent("on" + type, registry.splice(index, 1)[0][3]);
			}
		}
	};

	WindowPrototype[dispatchEvent] = DocumentPrototype[dispatchEvent] = ElementPrototype[dispatchEvent] = function (eventObject) {
		return this.fireEvent("on" + eventObject.type, eventObject);
	};
})(Window.prototype, HTMLDocument.prototype, Element.prototype, "addEventListener", "removeEventListener", "dispatchEvent", []);



(function() {

    //alert("fallback");
    var g = {};

	g.IsMobile = (navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(Android)|(BlackBerry)|(IEMobile)|(Opera Mini)|(webOS)/i) !== null);

    g.BrowserW = function() {
        return document.documentElement.clientWidth;
    }
    g.BrowserH = function() {
        return document.documentElement.clientHeight;
    }
    g.HasClass = function(node, className) {
        if (node.classList) {
            return node.classList.contains(className);
        } else {
            return new RegExp('(^| )' + className + '( |$)', 'gi').test(node.className);
        }
    }
    g.SetClass = function(node, className) {
        node.className = className;
    }
    g.removeClass = function(node, className) {
        if (node.classList) {
            node.classList.remove(className);
        } else {
            node.className = node.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    }
    g.addClass = function(node, className) {
        if (node.classList) {
            node.classList.add(className);
        } else {
            node.className += ' ' + className;
        }
    }

	g.scroll = function() {

		var scrollPos = document.body.scrollTop;

		if (scrollPos > g.section2.topPos && scrollPos < g.section2.bottomPos) {
			//logo invert
			if (!g.logo.inverted) {
				g.logo.inverted = true;
				g.logo.style.backgroundImage = "url('../img/logo/logoInvert.png')";
			}

		} else {
			//logo standard
			if (g.logo.inverted) {
				g.logo.inverted = false;
				g.logo.style.backgroundImage = "url('../img/logo/logo.png')";
			}
		}

		if (scrollPos > g.section3.topPos && scrollPos < g.section3.bottomPos) {
			//login new color

			if (!g.signup_header.dark) {
				g.signup_header.dark = true;
				console.log("g.signup_header.dark:   " + g.signup_header.dark);
				g.signup_header.style.backgroundColor = "#72a492";
			}
		} else {
			//login green
			if (g.signup_header.dark) {
				g.signup_header.dark = false;
				console.log("g.signup_header.dark:   " + g.signup_header.dark);
				g.signup_header.style.backgroundColor = "#a4d7c7";
			}
		}
	}
    g.resizeFallback = function() {

		g.section2.topPos = section2.offsetTop - 40;
		g.section2.bottomPos = g.section2.topPos + section2.offsetHeight;
		g.section3.topPos = section3.offsetTop - 40;
		g.section3.bottomPos = g.section3.topPos + section3.offsetHeight;

        // set landscape
        if (g.BrowserW() > g.BrowserH()) {
            g.SetClass(g.fallback, "landscape");
        }
        // portrait
        else {
            g.SetClass(g.fallback, "portrait");
        }

        // set height of all lis to browser height
        var i, node;
        for (i = 0; node = g.lis[i]; i++) {

            // set height of lis

            if (g.HasClass(node, "reuse")) {
                node.setAttribute("style","height:"+ g.BrowserH()*1.5 +"px");

            } else if (g.HasClass(node, "collaborate_paper")) {


                // calculate img height based on aspect ratio
                // var img = node.querySelector(".paper"); // ie8+
                var imgH = Math.round(node.offsetWidth*32/27); //16/9
                // img.setAttribute("style","height:"+ imgH +"px");
                // node.setAttribute("style","height:"+ Math.round(imgH*0.8 + browserH) +"px");
                node.setAttribute("style","height:"+ (imgH-100) +"px");

            } else if (g.HasClass(node, "signup")) {
                node.setAttribute("style","height:auto;");
            } else {
                node.setAttribute("style","height:"+ g.BrowserH() +"px");
            }
        }

		// only for mobile
		if (g.BrowserW() < 768) {
			//var num = 250; //g.features.offsetHeight;
			var height = (g.BrowserW()*0.7) * (4/3) + 300;
			//console.log("width: " + g.BrowserW() );
			// console.log("width: " + g.BrowserW()*0.7 );
			// console.log("height: " + height );
			g.features.setAttribute("style","height:" + height + "px;");
		} else {
			g.features.setAttribute("style","height: 600px;");
		}


    }

    // post email
    g.sendForm = function(url) {

        //console.log("sendForm ALIVE");


        // We setup our request
        var request = new XMLHttpRequest();
        request.open("POST", url, true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
        // request.onload
        // request.error


        // We define what will happen if the data are successfully sent
        request.addEventListener("load", function(event) {
            //console.log("Success!   " + event.target.responseText);
            g.formResponse(event.target.responseText)
        });

        // We define what will happen in case of error
        request.addEventListener("error", function(event) {
            g.showMessage("Something went wrong, please try again", true);
        });

        // The data sent are the one the user provide in the form
		//console.log("SEND email: " + encodeURIComponent(g.signup_mail.value));
        request.send("mail=" + encodeURIComponent(g.signup_mail.value)); // encode to include "+" sign     ex: adrian+springsummertest@podio.com


    }

    g.formResponse = function(response) {
        //console.log("formResponse ALIVE");

        var json = JSON.parse(response);
        //console.log("user_id: " + json.user_id);

        if (json.user_id) {
            g.showMessage("Thanks – check your mail and hit 'Confirm'", false);
        } else {
			this.showMessage("You have already signed up! Please <a href='http://app.getbeagle.co'>login</a>.", false);
        }
    }
    g.showMessage = function(msg, error) {
        //console.log("showMessage ALIVE");

        //show it!
        if (msg !== "") {

            // red or white text
            if (error) {

				if (g.IsMobile) {
					this.signup_mail.style.border = "1px solid #ed3d3d";

				} else {
					this.signup_msg.innerHTML = msg;
					g.removeClass(g.signup_msg, "hidden");
				}

            } else {
				g.signup_h3.innerHTML = msg;

				if (g.IsMobile) {
					g.signup_mail.style.border = "none";
				} else {
					g.addClass(g.signup_msg, "hidden");
				}
                //g.removeClass(g.signup_msg, "error");
            }
        }
        //hide it!
        else {

			if (g.IsMobile) {
				g.signup_mail.style.border = "none";
			} else {
            	g.addClass(g.signup_msg, "hidden");
			}
        }


    }
    g.validateForm = function(event) {
        //console.log("validateForm ALIVE");

        event.preventDefault();

        //validate mail
        var email = g.signup_mail.value;
		var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	var validEmail = re.test(email);


		if (validEmail) {
			//console.log("email is valid. send it to Podio: " + email);
			var url;
			if (window.location.href.indexOf('https://staging') !== -1) {
				url = "https://app-staging.getbeagle.co/inactive";
			} else {
				url = "https://app.getbeagle.co/inactive";
			}
			g.sendForm(url);

		} else {
			//console.log("NOT a valid email, please try again:  " + email);
			g.showMessage("Please enter a valid email", true);
		}

        /*
        ri@springsummer.dk
        */
    }


	g.orientationChange = function() {

		if (g.reload) {

			document.activeElement.blur();
			g.signup_mail.blur();
			window.scrollTo(0, document.documentElement.clientHeight);
			document.location.reload();
		}


		// switch(window.orientation) {
		// 	case -90:
		// 	case 90:
		// 		//alert('landscape');
		// 		break;
		// 	default:
		// 		//alert('portrait');
		// 		break;
		// }
	}


    g.loaded = function() {
        //console.log("fallback ALIVE");

        g.fallback = document.getElementById("fallback");
        g.lis = document.getElementById("fallback").getElementsByTagName("li");

		g.logo = document.getElementById("logoLink");
		g.signup_header = document.getElementById("signupButton");

		g.logo.addEventListener("click", function() {window.scrollTo(0, 0)} );

        // get form
		g.footer = document.getElementById("footer");
		g.features = g.footer.querySelector(".features"); // ie8+
        g.signup_form = document.getElementById("signup");
        g.signup_mail = document.getElementById("email");
        g.signup_msg = g.signup_form.querySelector("span"); // ie8+
		g.signup_h3 = g.signup_form.querySelector("h3"); // ie8+
        g.signup_button = document.getElementById("submit");
        g.signup_button.addEventListener("click", g.validateForm);



        // fix "enter" key
        g.signup_form.addEventListener("keypress", function (event) {
            var key = event.which || event.keyCode;
            if (key == 13) {
                // code for enter
                g.validateForm(event);
            }
        });


		// vars for scroll
		g.section2 = document.getElementById("section2");
		g.section3 = document.getElementById("section3");


        document.getElementsByTagName("body")[0].className = "fallback";
        window.addEventListener("resize", g.resizeFallback, false);
        g.resizeFallback();


		if (!g.IsMobile || g.fallback.offsetWidth > 640) {
			window.addEventListener("scroll", g.scroll, false);
		}


		// focus blur - flag to reload page on orientation change
		g.signup_mail.addEventListener("focus", function( event ) {g.reload = true}, true);
		g.signup_mail.addEventListener("blur", function( event ) {g.reload = false}, true);

		// Orientationchange
		window.addEventListener("orientationchange", g.orientationChange);
		g.orientationChange();

    }
    window.onload = g.loaded;


})();
