let abtShowCtmEle = document.getElementById("hidCtmHis");
var state=0;
function abtShowCtm(){
    state+=1;
    abtShowCtmEle.style.height='auto';
    document.getElementById("show_txt_oth").innerHTML="ย่อลง";
    if(state==2){
        document.getElementById("show_txt_oth").innerHTML="เเสดงเพิ่มเติม";
        state=0;
        abtShowCtmEle.style.height='';
    }
}
