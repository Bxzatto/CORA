function MudarTela(el,le) {
    var display = document.getElementById(el).style.display;
    var display2 = document.getElementById(le).style.display;
    if(display == "block"){
        document.getElementById(el).style.display = 'none';
        document.getElementById(le).style.display = 'block';
    }else{
        document.getElementById(el).style.display = 'block';
        document.getElementById(le).style.display = 'none';
    }
}
function SelecionarIMG(){
let itens = document.querySelectorAll(".imagens")
	itens.forEach(el => {
		el.onclick = () => {
			el.classList.toggle("selecionado")
		}
	})}
function desc(el){
    var display = document.getElementById(el).style.display;
    if(display == "block"){
        document.getElementById(el).style.display = 'none';
    }else{
        document.getElementById(el).style.display = 'block';
    }
}
function selectLugar(){
    let itens = document.querySelectorAll(".lugar")
        itens.forEach(el => {
            el.onclick = () => {
                el.classList.toggle("selecionado")
            }
        })}
