var 
pathArray = location.href.split('/'),
protocol = pathArray[0],
host = pathArray[2];

var ajax_url = protocol + '//' + host + '/rtwt/wp-admin/admin-ajax.php';

console.log(ajax_url);

module.exports = ajax_url;