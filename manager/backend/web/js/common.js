/* 全选
 * @p checkbox的容器ID 一般为form ID
   @name checkbox的name
 */
function checkall(checked, p, name) {
    $('#'+p+' :checkbox[name="'+name+'[]"]').prop('checked', checked);
}

/*更新
 *@ url	提交的路径
 *@ id	form_id
 */
function update_record(url, id,title){
	var list = $("[name='ckbox[]']:checked");
	//console.log(list);
	if(list.length<1){
		swal({   title: title,   timer: 2000,   showConfirmButton: false });
		return false;
	}
	$("#"+id).prop("action", url);
	$("#"+id).submit();
}



