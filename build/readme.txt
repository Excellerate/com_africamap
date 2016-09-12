The files here are for updating the African map and do not work with the componant in anyway.

# Should you need to add a country # 

1. Edit the map under /assets/img/map.svg 

2. Draw in the country.

3. Place the new path under the countries layer and name it.

4. Edit build.php and add the new name to the countries array.

5. Run the build file to update paths.js ie: > php build.php

6. Edit Joomlas default view file under /views/africa/tmpl/default to create actions etc.