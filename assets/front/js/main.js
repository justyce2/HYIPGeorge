(function ($) {
	"user strict";
	$(window).on("load", function () {
		$(".loader").fadeOut(500);
		var img = $(".bg_img");
		img.css("background-image", function () {
			var bg = "url(" + $(this).data("img") + ")";
			var bg = `url(${$(this).data("img")})`;
			return bg;
		});
	});
	$(document).ready(function () {
		$(".accordion-title").on("click", function (e) {
			var element = $(this).parent(".accordion-item");
			if (element.hasClass("open")) {
				element.removeClass("open");
				element.find(".accordion-content").removeClass("open");
				element.find(".accordion-content").slideUp(200, "swing");
			} else {
				element.addClass("open");
				element.children(".accordion-content").slideDown(200, "swing");
				element
					.siblings(".accordion-item")
					.children(".accordion-content")
					.slideUp(200, "swing");
				element.siblings(".accordion-item").removeClass("open");
				element
					.siblings(".accordion-item")
					.find(".accordion-title")
					.removeClass("open");
				element
					.siblings(".accordion-item")
					.find(".accordion-content")
					.slideUp(200, "swing");
			}
		});

		$(".counter-item").each(function () {
			$(this).isInViewport(function (e) {
				if ("entered" === e)
					for (
						var i = 0;
						i < document.querySelectorAll(".odometer").length;
						i++
					) {
						var n = document.querySelectorAll(".odometer")[i];
						n.innerHTML = n.getAttribute("data-odometer-final");
					}
			});
		});
		$("ul>li>.sub-nav").parent("li").addClass("parent-menu");
		$("ul")
			.parent("li")
			.hover(function () {
				var menu = $(this).find("ul");
				var menupos = $(menu).offset();
				if (menupos.left + menu.width() > $(window).width()) {
					var newpos = -$(menu).width();
					menu.css({
						left: newpos,
					});
				}
			});
		$(".nav-menu li a").on("click", function (e) {
			var element = $(this).parent("li");
			if (element.hasClass("open")) {
				element.removeClass("open");
				element.find("li").removeClass("open");
				element.find("ul").slideUp(300, "swing");
			} else {
				element.addClass("open");
				element.children("ul").slideDown(300, "swing");
				element.siblings("li").children("ul").slideUp(300, "swing");
				element.siblings("li").removeClass("open");
				element.siblings("li").find("li").removeClass("open");
				element.siblings("li").find("ul").slideUp(300, "swing");
			}
		});
		var scrollTop = $(".toTopBtn");
		$(window).on("scroll", function () {
			if ($(this).scrollTop() < 500) {
				scrollTop.removeClass("active");
			} else {
				scrollTop.addClass("active");
			}
		});
		$(".toTopBtn").on("click", function () {
			$("html, body").animate(
				{
					scrollTop: 0,
				},
				500
			);
			return false;
		});
		$(".nav-toggle").on("click", function () {
			$(this).toggleClass("active");
			$(".overlayer").toggleClass("active");
			$(".nav-menu-area, .dashboard-sidebar").toggleClass("active");
		});
		$(".overlayer, .menu-close").on("click", function () {
			$(".overlayer, .menu-close").removeClass("active");
			$(".nav-toggle").removeClass("active");
			$(".nav-menu-area, .dashboard-sidebar").removeClass("active");
		});

		$(".sidebar-close").on("click", function () {
			$(
				".nav-menu-area, .dashboard-sidebar, .nav-toggle, .overlayer, .menu-close"
			).removeClass("active");
		});
		$(".dashboard-header-profile").on("click", function () {
			$(this).siblings(".user-toggle-menu").toggleClass("active");
		});
		//Sticky Header
		var header = $("header");
		var fixed_top = $(".navbar-bottom");
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > header.height() + fixed_top.height()) {
				fixed_top.addClass("active");
			} else {
				fixed_top.removeClass("active");
			}
		});
		function spaceBottom() {
			return fixed_top.height();
		}
		$(window).on("resize", spaceBottom);
		header.css("padding-bottom", spaceBottom);

		var clientSlider = $(".client__slider").owlCarousel({
			items: 1,
			autoplay: true,
			margin: 0,
			dots: true,
			loop: true,
			animateIn: "fadeIn",
			animateOut: "fadeOut",
		});
		$(".owl-prev").on("click", function () {
			clientSlider.trigger("prev.owl.carousel");
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
		});
		$(".owl-next").on("click", function () {
			clientSlider.trigger("next.owl.carousel");
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
		});
		$(".partner-slider").owlCarousel({
			items: 2,
			autoplay: true,
			margin: 14,
			responsive: {
				576: {
					items: 3,
				},
				768: {
					items: 4,
				},
				992: {
					items: 5,
				},
				1200: {
					items: 6,
				},
			},
		});
		$(".brand-slider").owlCarousel({
			items: 2,
			autoplay: true,
			margin: 14,
			responsive: {
				576: {
					items: 3,
				},
				768: {
					items: 4,
				},
				992: {
					items: 3,
				},
			},
		});
		$(".owl-prev").html('<i class="fas fa-angle-left">');
		$(".owl-next").html('<i class="fas fa-angle-right">');

		$(".mode--toggle").on("click", function () {
			setTheme(localStorage.getItem("theme"));
		});
		if (localStorage.getItem("theme") == "dark-theme") {
			localStorage.setItem("theme", "light-theme");
		} else {
			localStorage.setItem("theme", "dark-theme");
		}
		setTheme(localStorage.getItem("theme"));
		function setTheme(theme) {
			if (theme == "dark-theme") {
				localStorage.setItem("theme", "light-theme");
				$("html").addClass(theme);
				$(".mode--toggle").html('<i class="fas fa-sun"></i>');
			} else {
				localStorage.setItem("theme", "dark-theme");
				$("html").removeClass("dark-theme");
				$(".mode--toggle").html('<i class="fas fa-moon"></i>');
			}
		}

		const userPanelHeight = () => {
			$(".dashborad--content").css("min-height", () => {
				var userBreadcrumb = $(".dashboard-header").height();
				return `calc(100vh - ${userBreadcrumb}px)`;
			});
		};
		$(window).on("resize", userPanelHeight);
		userPanelHeight();

		$(".dashboard-refer .input-group").on("click", () => {
			var textInput = $(this).find(".form-control");
			textInput.select();
			document.execCommand("copy");
		});
	});
})(jQuery);
