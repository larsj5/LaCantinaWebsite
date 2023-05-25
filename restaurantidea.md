## To run php:
php -S localhost:8000

## Talking points/TODOS for next meeting
* Think about the color scheme, at the moment we're going to get dinged for accessability. Looks clean though. 
* Need to properly add a header. [DONE]
* We're not very DRY atm with our database access. We might want to try and just have one connection as soon as you load the page, and properly use the config.ini and database wrapper. [DONE] 
* -> This includes adding an actual user specific to the database, and giving it a password. 
* I created a new version of the menu, it's responsive and seems to work well. [DONE]
* We need to have individual pages with further details for each menu item [DONE]
* -> Need to add more to each menu item for the details page (ingredients, gluten free, vegan, etc.) [DONE]
* -> And have a way to favorite the item
* Need a custom 404 page

FROM PROFESSOR:
* -> All of our paths for css and images are currently messed up because we are accessing from the php page not the html [DONE]
* -> Need to block access to the templates folder with .htaccess
* -> Need to create a seperate layout for main page and for other pages, and extend that layout [DONE]
* -> Need to have an index.php for the home page (can just render the page) [DONE]
* -> Scrap the original menu altogether and go with the menu2.php [DONE]
* -> All of the photos are way too big and need to be compressed to 50 kb or smaller
