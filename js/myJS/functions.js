const getDeviceType = () => {
  const device = navigator.userAgent;

  if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(device)) {
    return "tablet";
  }

  if (
    /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
      device
    )
  ) {
    return "mobile";
  }

  return "desktop";
};

document.addEventListener("scroll", function (event) {
  const stickyNav = document.querySelector(".navbar-sticky");
  const navSearch = document.querySelector("#navSearch");
  const navBarCol = document.querySelector('div[id^="navbarCollapse"]');
  const nav = navBarCol.querySelector('ul[class^="navbar-nav"]');
  const navLink = navBarCol.querySelectorAll('a[class^="nav-link"]');
  const dropDown = navBarCol.querySelectorAll('a[class^="dropdown-item"]');

  const device = getDeviceType();

  const scTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scTop >= 400) {
    stickyNav.addClass("navbar-sticky-custom");
    navSearch.addClass("nav-link-custom");
    nav.addClass("navbar-sticky-custom");

    navLink.forEach((item) => {
      item.addClass("nav-link-custom");
    });

    if (device !== "desktop") {
      dropDown.forEach((item) => {
        item.addClass("nav-link-custom");
      });
    }
  } else {
    stickyNav.removeClass("navbar-sticky-custom");
    navSearch.removeClass("nav-link-custom");
    nav.removeClass("navbar-sticky-custom");

    navLink.forEach((item) => {
      item.removeClass("nav-link-custom");
    });

    dropDown.forEach((item) => {
      item.removeClass("nav-link-custom");
    });
  }
});
