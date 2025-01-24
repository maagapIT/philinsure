function showAlert(i, h, m) {
// i = icon
// h = header
// m = message
	$('#alert').foundation('reveal', 'open');
	$('#alert i').removeAttr('class').addClass(i);
	$('#alert h5 span').html(h);
	$('#alert p').html(m);
	$('#alert a').focus(); // no effect
}
function showConfirmation(i, h, m) {
// i = icon
// h = header
// m = message
	$('#confirmation').foundation('reveal', 'open');
	$('#confirmation i').removeAttr('class').addClass(i);
	$('#confirmation h5 span').html(h);
	$('#confirmation p').html(m);
	$('#confirmation a').focus(); // no effect
}
function padZero(s, l) {
// s = string
// l = length
  s = s.toString();
  return s.length < l ? padZero('0' + s, l) : s;
}
function unformatCurrency(n) {
	return Number(n.replace(/,/g, ''));
}
function edit(m, i) {
// m = module
// i = record id
	angular.element('#' + m).scope().edit(i);
}
function del(m, i, n) {
// m = module
// i = record id
// n = record name
	angular.element('#' + m).scope().delete(i, n);
}
function view(m, i) {
// m = module
// i = record id
	angular.element('#' + m).scope().view(i);
}
function currency(m, n) {
// m = module
// n = number
	return angular.element('#' + m).scope().currency(n);
}
function percentage(m, n) {
// m = module
// n = number
	return angular.element('#' + m).scope().percentage(n);
}
function date(m, d) {
// m = module
// d = date
	return angular.element('#' + m).scope().date(d);
}
function datetime(m, d) {
// m = module
// d = date
	return angular.element('#' + m).scope().datetime(d);
}