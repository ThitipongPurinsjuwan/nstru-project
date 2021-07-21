# SelectionMenu

[![NPM version][npm-image]][npm-url]
[![Build status][travis-image]][travis-url]
[![Dependency Status][david-image]][david-url]
[![DevDependency Status][david-dev-image]][david-dev-url]
[![License][license-image]][license-url]
[![Downloads][downloads-image]][downloads-url]


SelectionMenu is a small, framework-agnostic JavaScript module that displays a custom context menu when the user selects text on the page.

This menu may offer a search feature, dictionary lookup, sharing on social media etc.

**[Live Demo](http://idorecall.github.io/selection-menu/)**

![SelectionMenu screencast](https://cloud.githubusercontent.com/assets/33569/8980688/639a4f74-3667-11e5-9f13-a778a1299f8c.gif)

The only dependency is [Tether.js](http://github.hubspot.com/tether/) for automatic positioning of the menu as the page is scrolled.
Automated cross-browser testing with Selenium driven by Node.js gracefully provided by [BrowserStack](https://www.browserstack.com/automate/node) TBI.


## History

The motivation for creating this module was having a sleek contextual selection mechanism in the Chrome extension for [iDoRecall](https://idorecall.com). 

This module was inspired by [Mathias Schäfer's work from 2011](https://github.com/molily/selectionmenu). It was brought up to date with modern browsers (Chrome, Firefox, Safari, Opera, IE9+) and the AMD module pattern, then revamped to use [HubSpot's Tether library](http://github.hubspot.com/tether/) for better positioning. A neat trick, detecting the direction of the selection (forward vs. backward), was inspired by [Xavier Damman](https://github.com/xdamman/)'s [selection-sharer](https://github.com/xdamman/selection-sharer).

The idea and the implementation originally resemble the selection context menu on nytimes.com, but the script is way simpler and easier to integrate. 


## Features and differences from the original

* Display the context menu near where the mouse button was released (the original always displayed the menu at the end of the selection, and selection-sharer displays it [asymmetrically](https://github.com/xdamman/selection-sharer/issues/18) and [always at the top of the selection](https://github.com/xdamman/selection-sharer/issues/17))
* Pass any HTML for the context menu, and style it as you want
* The menu text is made unselectable (fixes a number of [bugs in the original library](https://github.com/molily/selectionmenu/issues/5))
* Supports minimum and maximum selection length ([selection-sharer #10](https://github.com/xdamman/selection-sharer/issues/13))
* Clicking outside the popover *always* closes the menu (fixes [selection-sharer #11](https://github.com/xdamman/selection-sharer/issues/11))
* Synthetic `onselect` event you can hook into
* Dynamic menu depending on the content of the selection
* Selection and menu are preserved when scrolling the document via the scrollbar thumb
* The menu automatically repositions itself when it would be outside the top/bottom bounds of the visible viewport

Keyboard events are not handled, so that if the user wants to make fine adjustments to the selection with Shift+arrows, the menu will remain near the mouse cursor


## Usage

Create an instance of SelectionMenu by calling `new SelectionMenu`.

Pass an object literal with the following options:

* `container` (DOM element): The element where the copy event is observed. Normally that's the main text container.
* `content` (string or DOM element): An HTML string for the menu, or a DOM element containing the menu. If the element was `hidden` or had `display: none`, we'll show and hide it appropriately.
* `menuHTML` (string): *DEPRECATED* - use `content` instead. A string of HTML for the menu, such as list of links. Typically obtained via `.innerHTML`. TODO or get it from a textarea like Webix
* `handler` (function): A handler function which is called when the user clicks on the menu. Use the passed click event to access the click link and respond to the user's action.
* `minlength` (number, optional): Only display the menu if the selected text has at least this length. Defaults to 5 characters.
* `maxlength` (number, optional): Only display the menu if the selected text is at most this long. Defaults to `Infinity`.
* `id` (string, optional): The ID of the menu element which is inserted. Defaults to `selection-menu`.
* `onselect` (function, optional): Custom event generated when the mouse/finger selection changes. Not generated when the selection is changed via the keyboard. Use it to customize the menu dynamically based on the contents of the selection:

    ```js
    new SelectionMenu({
      ...
      onselect: function (e) {
        this.menu.innerHTML = 'Selection length: ' + this.selectedText.length;
      }
    });
    ```

The menu styling is completely up to you. See [`selection-menu.css`](demos/gh-pages/selection-menu.css) in the `demos` for a simple example, and [`iDoRecall-menu.less`](demos/iDoRecall-menu.less) for a more complex one.


## Properties

* `menu` - the menu DOM element that SelectionMenu creates. Modify its innerHTML to adjust the menu on the fly according to the selection.
* `selectionStartElement`, `selectionEndElement` - DOM elements that the selection starts and end with (can be the same)


## Methods

* `hide(hideSelection=false)` - hide the menu, optionally clearing the text selection as well. Useful at the end of the click `handler`.


## Example

This observes mouseup events on the element with the ID `article`. It inserts a menu
with two links which both have IDs to recognize them. In the handler function, the
selected text is read. Depending on the clicked link, the selected text is
looked up on Google or Bing.

```js
new SelectionMenu({
  container: document.getElementById('article'),
  content: '<a id="selection-menu-google">Google it</a><a id="selection-menu-bing">Bing</a>',
  handler: function (e) {
    var target = e.target,
      id = target.id,
      selectedText = this.selectedText,
      query = encodeURI(selectedText.replace(/\s/g, '+')),
      searchURI;
    
    if (id === 'selection-menu-google') {
      searchURI = 'http://www.google.com/search?q=';
    } else if (id === 'selection-menu-bing') {
      searchURI = 'http://www.bing.com/search?q=';
    }
    
    location.href = searchURI + query;
  }
});
```

To define menus more flexibly, use a hidden `<div>` in your HTML, and pass its `innerHTML` to SelectionMenu:

```html
<div id="mymenu" hidden>
  <ul>
    <li>Option one
    <li>Option two
  </ul>  
</div>
```

```js
new SelectionMenu({
  container: document.getElementById('article'),
  menuHTML: document.getElementById('mymenu').innerHTML,
  handler: function (e) {
    ...
  }
});
```


## Browser compatibility

The script uses the [W3C DOM Range](http://www.w3.org/TR/DOM-Level-2-Traversal-Range/ranges.html), which is [available in modern browsers](https://developer.mozilla.org/en-US/docs/Web/API/Range): IE9+, Chrome, Firefox, Safari, Opera. HubSpot's [Tether library does not support IE8 for good reasons](http://github.hubspot.com/tether/overview/why_we_dont_support_ie_8/).


## Known issues

* The menu stays contained between the top and bottom boundaries of the container, but not between the left and right ones - [#3](https://github.com/iDoRecall/selection-menu/issues/3)
* [Triple clicking to select a paragraph](https://github.com/iDoRecall/selection-menu/issues/1) lands the menu below the selection in Chrome (this is a Chrome bug)
* Selecting table cells in Gecko browsers like Firefox doesn't position the menu where the selection has ended, due to [multiple ranges being created](https://developer.mozilla.org/en-US/docs/Web/API/Selection/rangeCount).


## Upcoming features

* Automatically align left or right the menu arrow if it was created near the left or right border of the container. For now it's always centered.


## License and copyright

Maintainer: Dan Dascalescu ([@dandv](https://github.com/dandv))

Copyright (C) 2015 [iDoRecall](http://idorecall.com), Inc.

The MIT License (MIT)



[npm-image]: https://img.shields.io/npm/v/selection-menu.svg?style=flat-square
[npm-url]: https://npmjs.org/package/selection-menu
[travis-image]: https://img.shields.io/travis/iDoRecall/selection-menu.svg?style=flat-square
[travis-url]: https://travis-ci.org/iDoRecall/selection-menu
[david-image]: http://img.shields.io/david/idorecall/selection-menu.svg?style=flat-square
[david-url]: https://david-dm.org/idorecall/selection-menu
[david-dev-image]: https://img.shields.io/david/dev/idorecall/selection-menu.svg?style=flat-square
[david-dev-url]: https://img.shields.io/david/dev/idorecall/selection-menu
[license-image]: https://img.shields.io/:license-mit-blue.svg?style=flat-square
[license-url]: LICENSE.md
[downloads-image]: http://img.shields.io/npm/dm/selection-menu.svg?style=flat-square
[downloads-url]: https://npmjs.org/package/selection-menu
