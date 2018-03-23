// JavaScript Document
//全选、反选、批量操作
function SelectAll(action,formid,inputid){ 
    var testform=document.getElementById(formid); 
    for(var i=0 ;i<testform.elements.length;i++){ 
        if(testform.elements[i].type=="checkbox"){ 
            e=testform.elements[i]; 
			if(e.id==inputid)
			{
            if(action=="selectAll")e.checked=1;
			else if(action=="")e.checked=!e.checked;
			else if(action=="selectNo")e.checked=0;
			}
        } 
    }     
}

//批量操作时判断是否选择数据
function checkdelform(formid,inputid){
	var testform=document.getElementById(formid); 
    for(var i=0 ;i<testform.elements.length;i++){if(testform.elements[i].type=="checkbox"){e=testform.elements[i]; if(e.checked==1&&e.id==inputid) return true;}}
	alert('您没有选择任何数据');return false;
}

//删除前提示
function ask(url){if(confirm('您确定要删除吗？'))location=url;}
//post
function post(url2,data2){
	//alert(url2);alert(data2);
	$.ajax({url: url2,type: 'post',dataType:'html',data:data2,timeout: 10000,
				 error: function(){ 
				 alert('Error loading XML document');
				 },
				 success: function(html){eval(html)}
	});
}