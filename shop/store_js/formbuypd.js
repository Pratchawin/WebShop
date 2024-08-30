function getInpData(){
    var get_fname=document.getElementById("fname").value;
    var get_lname=document.getElementById("lname").value;
    var get_email_val=document.getElementById("email").value;
    var get_phone_val=document.getElementById("phone").value;
    var get_country_val=document.getElementById("country").value;
    var get_postal_code_val=document.getElementById("postal_code").value;
    var get_subdistrict_val=document.getElementById("subdistrict").value;
    var get_district_val=document.getElementById("district").value;
    var get_province_val=document.getElementById("province").value;
    var get_etc_val=document.getElementById("etc").value;
    var get_quantity=document.getElementById("pd_quantity").innerHTML;

    var get_pdname=document.getElementById("smr_get_pd_name").innerHTML;
    var get_shipment_ex=document.getElementById("smr_shipment_ex").innerHTML;
    var get_total_price=document.getElementById("s_total_price").innerHTML;
    var get_pd_prop=document.getElementById("show_pd_prop").innerHTML;
    document.getElementById("inp_pd_prop").value=get_pd_prop;
    console.log("Frist name:",get_fname);
    console.log("Last name:",get_lname);
    console.log("Country:",get_country_val);
    console.log("Postal_code:",get_postal_code_val);
    console.log("Subdistrict:",get_subdistrict_val);
    console.log("District:",get_district_val);
    console.log("Province:",get_province_val);
    console.log("Etc:",get_etc_val);
    console.log("Quantity:",get_quantity[0]);

    document.getElementById("inp_fname").value=get_fname;
    document.getElementById("inp_lname").value=get_lname;
    document.getElementById("inp_email").value=get_email_val;
    document.getElementById("inp_phone").value=get_phone_val;
    document.getElementById("inp_country").value=get_country_val;
    document.getElementById("inp_zip_code").value=get_postal_code_val;
    document.getElementById("inp_tambon").value=get_subdistrict_val;
    document.getElementById("inp_amphoe").value=get_district_val;
    document.getElementById("inp_province").value=get_province_val;
    document.getElementById("inp_address").value=get_etc_val;
    document.getElementById("inp_quantity").value=get_quantity[0];

    console.log("get_pdname",get_pdname);
    console.log("get_shipment_ex",get_shipment_ex);
    console.log("get_total_price",get_total_price);

    document.getElementById("pd_name").value=get_pdname;
    document.getElementById("shipment_ex").value=get_shipment_ex;
    document.getElementById("smr_total_price").value=get_total_price;
}
