var 
pathArray = location.href.split('/'),
protocol = pathArray[0],
host = pathArray[2];

var ajax_url = protocol + '//' + host + '/cg_base/wp-admin/admin-ajax.php';

module.exports = ajax_url;