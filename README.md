# assignmenttest
Scandiweb test assignment a huge refactoring of my previous attempt at the test assignment

Key Changes:

- Completely overhauled the routing system to somewhat resemble laravel routing with the request method passed in the routes params and all that, just figured its a lot more 
  structured and effiecent than my bare bones routing system.


- Implemented more validation and refactored the validation to be more consistent all across.
  

- No if-else or conditional statements used in handling different products as per requirements.

  
- introduced a helper class for the formatting and displaying of each product attributes which in turn simplified the view template.


- Refactored view templates into dynamic partials for the head and banner sections and refactored the product cards into one card that dynamically displays the attribute for 
  each product, all while avoiding if-else or conditional statements as best i could.
