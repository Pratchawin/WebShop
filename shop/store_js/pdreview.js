let showPrmElm = document.getElementById("show_oth_content");
let ShowOthTitle = document.getElementById("ShowOthTitle");
function BtnShowPdrwOth() {
    showPrmElm.style.height = "auto";
    showPrmElm.style.display = "block";
    ShowOthTitle.style.display = "none";
}
let ckk_sh_status=0;
function BtnDelPdrwOth(n) {
    ckk_sh_status+=1;
    console.log("Ckk status",ckk_sh_status);
    showPrmElm.style.height = "auto";
    ShowOthTitle.style.display = "block";
    if(ckk_sh_status==1){
        document.getElementById("title_btn_oth").innerHTML="ย่อลง";
    }
    if(ckk_sh_status==2){
        ckk_sh_status=0;
        showPrmElm.style.height="55px";
        document.getElementById("title_btn_oth").innerHTML="เพิ่มเติม";
    }
}
let pdquantity = 0;
document.getElementById("pdrwquantitty").innerHTML = 0;
function BtnPdReviewIncAndRed(prm) {
    console.log(prm)
    if (prm == '+') {
        pdquantity += 1;
        document.getElementById("pdrwquantitty").innerHTML = pdquantity;
    } else {
        pdquantity -= 1;
        console.log(pdquantity);
        document.getElementById("pdrwquantitty").innerHTML = pdquantity;
        if (pdquantity < 0) {
            document.getElementById("pdrwquantitty").innerHTML = 0;
            document.getElementById("inppdquan").value = 0;
            pdquantity = 0;
        }
    }
    document.getElementById("inppdquan").value = pdquantity;
    document.getElementById("inppdquan2").value = pdquantity;
}

var changeImgEle=document.getElementById("main_preview");
sessionStorage.setItem("img",changeImgEle.src);
function previewImage(i) {
    var previewImage2 = document.getElementById("preview_image"+i).src;
    document.getElementById("preview_image2").src=sessionStorage.getItem("img");
    changeImgEle.src=previewImage2;
}


function check_pd_quantity() {
    var ckk_pd_quantity = document.getElementById("pdrwquantitty").innerHTML;
    var formEle=document.getElementById("form_set_action");
    var pd_id=document.getElementById("pd_id").value;
    var ctt_id=document.getElementById("ctt_id").value;
    console.log("Product id:",pd_id,"Category id:",ctt_id);
    if (ckk_pd_quantity<=0) {
        alert("จำนวนสินค้าไม่ถูกต้อง");
        formEle.action="http://localhost/bestbuy/shop/pdreview.php";
    }
}

var ckk_id=document.getElementById('0').innerHTML;
if(ckk_id=="สินค้าหมด"){
    document.getElementById("ckk_btn_qt_is_null").style.display="none";
    document.getElementById("ckk_btn_qt_is_null2").style.display="none";
}
console.log("Hello world");

function select_pd_prop() {
    var x = document.getElementById("scl_pd_prop").value;
    document.getElementById("inp_pd_prop").value= x;
    document.getElementById("test").innerHTML= x;
  }