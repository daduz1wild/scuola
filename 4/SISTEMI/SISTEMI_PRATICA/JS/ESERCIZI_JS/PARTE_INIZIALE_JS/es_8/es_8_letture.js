function leggiNum(msg,vmin,vmax){
	let n;
	do{
		n=parseInt(prompt(msg));
		if(n<vmin || n>vmax)
			alert("errore, reinserire");
	}while(n<vmin || n>vmax);
	return n;
}