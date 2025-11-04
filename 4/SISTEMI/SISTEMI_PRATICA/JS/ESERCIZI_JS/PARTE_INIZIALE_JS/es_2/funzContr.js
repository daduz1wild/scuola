<!--Benedetti Davide funzContr.html-->

function contrInt(vmin, vmax, n) {
	corretto = true;
	if (n<vmin || n>vmax ) {
		corretto=false;
	}
	return corretto;
}
function contrStr(str) {
	corretto=true;
	if (str==="" || str===NULL) {
		corretto = false;
	}
	return corretto;
}