# SelectionMenu changelog

## 2015-09-10, v3.4.1

* return the selection start and end DOM Elements
* better handling of clicks on the menu


## 2015-09-04, v3.4.0

* Firefox support for textareas
* display the menu even if the selection ends outside the container
* clearer mouse event handling
* more test cases


## 2015-09-03, v3.3.0

* handle selection in textareas, though imperfectly without textarea-caret-position
* reset CSS more robustly with `all: unset`
* hide the menu according to browser selection clearing vagaries


## 2015-08-30, v3.2.0

* drop dependency on Drop, use Tether directly
* deprecate `menuHTML` in favor of `content`


## 2015-07-29, v3.1.0

* using [HubSpot's Drop](http://github.hubspot.com/drop/) library for better positioning
* this is a pre-release before dropping Drop and using [Tether](http://github.hubspot.com/tether/) directly
* update iDoRecall demo text instead of the Lorem Ipsum


## 2015-06-03, v2.0.1

* revamp [Molily's library](https://github.com/molily/selectionmenu)
