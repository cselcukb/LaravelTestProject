Please download the project from github.
After downloading the project, run sh docker/setup.sh on Linux. The project will be installed on 127.0.0.1:8000.

URLs in the project:
GET -> http://127.0.0.1:8000/api/markers -> get all markers
GET -> http://127.0.0.1:8000/api/markers/{marker_id} -> get single marker by id

POST ->http://127.0.0.1:8000/api/markers -> add marker
POST ->http://127.0.0.1:8000/api/markers/{marker_id} -> update marker

The URL that locates the markers according to the shortest distance by taking the first marker as the base location ->
http://127.0.0.1:8000/api/markers/calculateRoute
In order to test this URL, you can send this value under markers parameter name:
["41.02572934629449, 28.974438863081275", "41.005539632352374, 28.976740761065997", "41.03345092597432, 28.98348273638836", "41.0267251327222,28.980286587668328", "41.04349638842987, 28.990389047663882", "41.00843802767273, 28.971035021951337", "41.02198291581627,28.976296422585385", "41.04133709671935, 29.00667655163188", "41.008689057643686, 28.980195995586328"]

I have added two custom classes to the project: I have also added test files for these classes:
You can run the tests by running vendor/bin/phpunit under project directory.
