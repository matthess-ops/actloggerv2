1: in index.php change lines to

require __DIR__.'/./setup/vendor/autoload.php';
$app = require_once __DIR__.'/./setup/bootstrap/app.php';

2: change the db stuff in .env file to 

DB_CONNECTION=mysql
DB_HOST=rdbms.strato.de
DB_PORT=3306
DB_DATABASE=dbs5070470
DB_USERNAME=dbu1335044
DB_PASSWORD=Gerard1957

2: copy paste everything in public folder to base directory on strato
3: zip everything except public folder and nodemodules into setup folder
4: transfer everything to server
