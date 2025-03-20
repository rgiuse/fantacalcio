function controlla() {

	var parole=/[0-9]+/;
	var numeri=/[A-z]+/;


	if (document.UserData.name.value=="" | document.UserData.name.value==null) {
		alert("Manca il Nome");
		return 3;
	}
	temp=document.UserData.name.value;
	if (parole.test(temp)) {
		alert("Il nome NON deve contenere numeri");
		return 3;
	}


	if (document.UserData.fname.value=="" | document.UserData.fname.value==null) {
		alert("Manca il Cognome"); 
		return 4;
	}
	temp=document.UserData.fname.value;
	if (parole.test(temp)) {
		alert("Il cognome NON deve contenere numeri");
		return 4;
	}


	if (document.UserData.address.value=="" | document.UserData.address.value==null) {
		alert("Manca l'indirizzo"); 
		return 5;
	}
	temp=document.UserData.address.value;
	if (!(numeri.test(temp))) {
		alert("L'indirizzo NON deve contenere SOLO numeri");
		return 5;
	}


	if (document.UserData.telephone.value=="" | document.UserData.telephone.value==null) {
		alert("Manca il numero di telefono"); 
		return 6;
	}
	if (isNaN(document.UserData.telephone.value)) {
		alert("Il numero di telefono DEVE essere un numero");
		return 6;
	}
	temp=document.UserData.telephone.value;
	if (temp.length<6) {
		alert("Il numero di telefono DEVE essere un numero di almeno 6 cifre");
		return 6;
	}


	if (document.UserData.username.value=="" | document.UserData.username.value==null) {
		alert("Manca l'username");
		return 7;
	}

	if (document.UserData.password.value=="" | document.UserData.password.value==null) {
		alert("Manca la password"); 
		return 8;
	}

	if (document.UserData.rpassword.value=="" | document.UserData.rpassword.value==null) {
		alert("Devi anche riscrivere la password"); 
		return 9;
	}

	if (!(document.UserData.password.value.toString() == document.UserData.rpassword.value.toString())) {
		alert("La password e la sua riscrittura devono essere uguali"); 
		return 10;
	}
	return true;
}
