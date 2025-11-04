//Benedetti Davide 4BI index.html
const descr=[];
const car=[];
descr.push("La Monna Lisa è uno dei dipinti più celebri al mondo. Il quadro ritrae una donna seduta con un'espressione enigmatica e un sorriso appena accennato. Lo sfondo è un paesaggio naturale con colline e un fiume, avvolto in una leggera foschia. La particolarità dell'opera risiede nella tecnica dello sfumato, che dona una qualità eterea e tridimensionale al soggetto. Gli occhi della donna sembrano seguire lo spettatore, conferendo al dipinto un senso di interattività.");
descr.push("Descrizione: Questo quadro è un'esplosione di emozioni e colori che rappresentano il cielo notturno visto dalla finestra dell'ospedale psichiatrico dove Van Gogh si trovava. Il cielo è animato da vortici di luce, una grande luna gialla e stelle che sembrano pulsare. In primo piano c'è un cipresso, che si erge come una fiamma, mentre sotto il cielo si intravede un villaggio tranquillo. L'opera è nota per il suo movimento dinamico e per l'uso espressivo del colore.");
descr.push("Questo quadro rappresenta il grande scrittore russo Lev Tolstoj, noto per opere come Guerra e Pace e Anna Karenina. L'artista lo ritrae seduto, con un aspetto semplice e contemplativo, indossando una tunica scura. Tolstoj appare immerso nei suoi pensieri, riflettendo il suo carattere profondo e filosofico. Lo sfondo è sobrio, mettendo in evidenza la personalità del soggetto.");
car.push("Monna Lisa <br> Altezza: <br> 77 cmLarghezza: 53 cmTecnica: <br> Olio su tavola di pioppo");
car.push("La Notte Stellata <br>Altezza: 73,7 cm <br> Larghezza: 92,1 cm <br> Tecnica: Olio su tela");
car.push("Ritratto di Tolstoj <br> Altezza: 110 cm <br> Larghezza: 85 cm <br> Tecnica: Olio su tela");
function descrz(n){
	switch(n){
		case 1:
			document.getElementById("out").innerHTML=descr[0];
			break;
		case 2: 
			document.getElementById("out").innerHTML=descr[1];
			break;
		case 3:
			document.getElementById("out").innerHTML=descr[2];
			break;
	}
}

function carat(n){
	switch(n){
		case 1:
			document.getElementById("out").innerHTML=car[0];
			break;
		case 2: 
			document.getElementById("out").innerHTML=car[1];
			break;
		case 3:
			document.getElementById("out").innerHTML=car[2];
			break;
	}
}