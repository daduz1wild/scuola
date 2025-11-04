.add aggiunge elemento in un array

ArrayList<String> nomi=new ArrayList<>();
for(int i=0;i<nomi.size();i++){
	System.out.println(nomi.get(i));
}
 
foreach(vuole come primo elemento una variabile di appoggio, ad esempio nel nostro caso dichiariamo una variabile strung, secondo parametro nome della stringa che vogliamo iterare).
col foreach non abbiamo una condizione ma scorriamo tutti gli element dell'array.
for(String s : nomi){
	System.out.println(s);
}