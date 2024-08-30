function BtnChangeBgColor(BtnNum) {
    if (BtnNum) {
        sessionStorage.setItem('num', BtnNum)
    }
}
btnNumChangColor = sessionStorage.getItem('num')
if (btnNumChangColor) {
    document.getElementById("ds_change_color" + btnNumChangColor).style.backgroundColor = 'white';
    document.getElementById("ds_change_color" + btnNumChangColor).style.color = '#0788D9';
    document.getElementById("ds_change_color" + btnNumChangColor).style.borderTopLeftRadius = '50px';
    document.getElementById("ds_change_color" + btnNumChangColor).style.borderBottomLeftRadius = '50px';
}
//เเสดงตัวอย่างรูปภาพสินค้า
function getImageFile(n) {
    let url = null;
    let fileObj = document.getElementById("image_file" + n).files[0];
    if (window.createObjcectURL != undefined) {
        url = window.createOjcectURL(fileObj);
    } else if (window.URL != undefined) {
        url = window.URL.createObjectURL(fileObj);
    } else if (window.webkitURL != undefined) {
        url = window.webkitURL.createObjectURL(fileObj);
    }
    console.log(url)
    document.getElementById("showImg" + n).src = url;
}
function deleteImg(n) {
    document.getElementById("showImg" + n).src = '';
    document.getElementById("image_file" + n).value = null;
    document.getElementById("showBtnDel" + n).style.display = "none";
}

function refresh_page() {
    document.getElementById("refresh_order_page");
}
setInterval(refresh_page, 6000);

var pd_name = document.getElementById('his-pd-name').innerHTML;
console.log(pd_name);

function show_manue(ss){
    console.log(ss+=1);
}