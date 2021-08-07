document.addEventListener("scroll", function (event) {
  const stickyNav = document.querySelector(".navbar-sticky");
  const navBarCol = document.querySelector('div[id^="navbarCollapse"]');
  const nav = navBarCol.querySelector('ul[class^="navbar-nav"]');
  const navLink = navBarCol.querySelectorAll('a[class^="nav-link"]');

  const scTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scTop >= 400) {
    stickyNav.addClass("navbar-sticky-custom");
    nav.addClass("navbar-sticky-custom");
    navLink.forEach((item) => {
      item.addClass("nav-link-custom");
    });
  } else {
    stickyNav.removeClass("navbar-sticky-custom");
    nav.removeClass("navbar-sticky-custom");
    navLink.forEach((item) => {
      item.removeClass("nav-link-custom");
    });
  }
});
