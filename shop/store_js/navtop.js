let navLeftStat=0;
let manueNavTopEle=document.getElementById("showManueRespTop");
function showNavLeft(){
    let navLeftIcon=document.getElementById("showManueRespTop");
    navLeftIcon.style.display="block";
    navLeftStat+=1;
    if(navLeftStat==2){
        manueNavTopEle.style.display="none";
        navLeftStat=0;
    }
}
function CloseManueNavTop(){
    manueNavTopEle.style.display="none";
}
let linkStatus=0;
function showLinklist(n){
    let linkListEle=document.getElementById("showLinklist"+n);
    linkListEle.style.display="block";
    linkStatus+=1;
    if(linkStatus==2){
        linkListEle.style.display="none";
        linkStatus=0;
    }
}