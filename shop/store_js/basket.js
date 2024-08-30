
function getPdQuantity(n){
    var pd_quantity=document.getElementById("inp_quantity"+n).value;
    document.getElementById("quantity_val"+n).value=pd_quantity;
}

function checkValue(n){
    var pd_quantity=document.getElementById("inp_quantity"+n).value;
    if(pd_quantity<0){
        document.getElementById("inp_quantity"+n).value=0;        
    }
}

var ckk_pd_price= document.getElementById("ckk_pd_price").innerHTML;
if(ckk_pd_price<=0){
    document.getElementById("pd_quantity").innerHTML=0;
}
