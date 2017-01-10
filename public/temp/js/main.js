/**
 * Created by sonnv on 08/05/2015.
 */
function httpPost(form){
    var formURL = form.attr("action");
    var postData = form.serializeArray();
    $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR)
            {
                if(data=="success"){
                    window.location.reload();
                }else{
                    alert(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);//if fails
            }
        });
}

function saveEntity(form, entity_id){
    var formURL = form.attr("action");
    var postData = form.serializeArray();
    var save_btn = form.find('button#save-btn')
    $.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            beforeSend: function( xhr ) {
                save_btn.button('loading')
            },
            success:function(data, textStatus, jqXHR)
            {
                if($('button[data-map="'+entity_id+'"]').length > 0){
                    var btn_info = $('button[data-map="'+entity_id+'"]').prev()
                    var encodeData = Base64.encode(data);
                    btn_info.attr('data-map', encodeData)
                    alert('Lưu lại thành công!')
                }
                else{
                    alert('Thêm mới thành công!')
                }
				console.log(data)
                save_btn.button('reset')
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);//if fails
                save_btn.button('reset')
            }
        });
}
function saveEntity2(form, entity_id){
    var formURL = form.attr("action");
    var postData = form.serializeArray();
    var save_btn = form.find('button#save-btn2')
    $.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            beforeSend: function( xhr ) {
                save_btn.button('loading')
            },
            success:function(data, textStatus, jqXHR)
            {
                alert('Lưu lại thành công!')
				save_btn.button('reset')
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);//if fails
                save_btn.button('reset')
            }
        });
}

function formatTimeVN(date){
    return ("0" + date.getDate()).slice(-2) + "-" + ("0"+(date.getMonth()+1)).slice(-2) + "-" + date.getFullYear() + " " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2)
}

$(document).ready(function(){
    $("input#btn-login").on("click",function(){
       httpPost($(this).closest("form"));
    });
    $('#modal-confirm').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        var data = button.data('map')
        var docType = button.data('doc')
        modal.find('input[name="id"]').val(data)
        if(docType != null ) modal.find('input[name="doc_type"]').val(docType)
    });

	$('#modal-chat').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        var data = button.data('map')
		var d = data.split("_")
        modal.find('input[name="id"]').val(d[0])
        modal.find('input[name="server"]').val(d[1])
        modal.find('input[name="owner"]').val(d[2])
    });

    $(document).on('click', 'button#save-btn', function(){
        var form = $(this).closest('form')
        var id = form.find('input[name="id"]').val()
        saveEntity(form, id)
    });
	$(document).on('click', 'button#save-btn2', function(){
        var form = $(this).closest('form')
        var id = form.find('input[name="id"]').val()
        saveEntity(form, id)
    });
});
// Create Base64 Object
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}