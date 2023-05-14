## To run php:
php -S localhost:8000

## Talking points/TODOS for next meeting
* Menu rendering is extremely slow -> I think we need to potentially get rid of the background images and the images in the sticky header. Could also look into decreasing the size/quality of the images. 
* We may just want to scrap the sticky header altogether, it has a lot of issues at the moment. Needs to be able to resize correctly, not cover the menu header, and not initially show up on the right when the page first loads. 
* Think about the color scheme, at the moment we're going to get dinged for accessability. Looks clean though. 
* Need to properly add a header. 
* We're not very DRY atm with our database access. We might want to try and just have one connection as soon as you load the page, and properly use the config.ini and database wrapper. 
* -> This includes adding an actual user specific to the database, and giving it a password. 
